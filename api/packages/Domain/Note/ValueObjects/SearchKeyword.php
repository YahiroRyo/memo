<?php

namespace Packages\Domain\Note\ValueObjects;

use Packages\Domain\StringLengthLimit;

final class SearchKeyword extends StringLengthLimit
{
    protected string $name = 'キーワード検索';
    protected int $minLengthLimit = 0;
    protected int $maxLengthLimit = 255;

    public function generateLikeQueryOfSql(): string
    {
        return '%' . $this->value() . '%';
    }

    /** @return string[] */
    public function generateLikeQueriesOfSql(int $count): array
    {
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[] = $this->generateLikeQueryOfSql();
        }
        return $result;
    }

    public static function elseDefaultEmptyString($value): SearchKeyword
    {
        if (!$value) {
            return SearchKeyword::from('');
        }

        return SearchKeyword::from($value);
    }
}
