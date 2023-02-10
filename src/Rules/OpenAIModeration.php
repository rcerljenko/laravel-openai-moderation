<?php

namespace RCerljenko\LaravelOpenAIModeration\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use RCerljenko\LaravelOpenAIModeration\Services\OpenAIHandler;

class OpenAIModeration implements InvokableRule
{
	public function __toString(): string
	{
		return self::class;
	}

	/**
	 * Run the validation rule.
	 */
	public function __invoke($attribute, $value, $fail): void
	{
		if (!$value || !config('openai.enabled')) {
			return;
		}

		$openAIHandler = new OpenAIHandler;

		$value = $openAIHandler->moderations(strip_tags($value));

		if (!$value || $value['results'][0]['flagged']) {
			$fail('openai::validation.inappropriate-content')->translate(['attribute' => $attribute]);
		}
	}
}
