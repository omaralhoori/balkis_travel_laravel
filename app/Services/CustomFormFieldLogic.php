<?php

namespace App\Services;

use App\Models\FormField;

class CustomFormFieldLogic
{
    public static function fieldIsVisible(FormField $field, array $answers): bool
    {
        $rules = $field->conditionalRulesList();

        if ($rules === []) {
            return true;
        }

        foreach ($rules as $rule) {
            if (! self::ruleMatches($rule, $answers)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param  array{field_key?: string, operator?: string, value?: string}  $rule
     */
    public static function ruleMatches(array $rule, array $answers): bool
    {
        $fieldKey = $rule['field_key'] ?? '';
        $operator = $rule['operator'] ?? 'equals';
        $expected = (string) ($rule['value'] ?? '');
        $answer = $answers[$fieldKey] ?? '';

        if (is_array($answer)) {
            return match ($operator) {
                'equals' => in_array($expected, $answer, true),
                'not_equals' => ! in_array($expected, $answer, true),
                'contains' => collect($answer)->contains(fn ($item): bool => str_contains((string) $item, $expected)),
                default => false,
            };
        }

        $answerString = (string) $answer;

        return match ($operator) {
            'equals' => $answerString === $expected,
            'not_equals' => $answerString !== $expected,
            'contains' => str_contains($answerString, $expected),
            default => false,
        };
    }
}
