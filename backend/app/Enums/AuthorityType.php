<?php

declare(strict_types=1);

namespace App\Enums;

enum AuthorityType: int implements EnumInterface
{
    case Operator = 1;
    case Administrator = 2;
    case UniquestAdministrator = 3;
    case System = 4;

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return match ($this) {
            AuthorityType::Operator => '一般ユーザー',
            AuthorityType::Administrator => '管理者',
            AuthorityType::UniquestAdministrator => 'UQ管理者',
            AuthorityType::System => 'システム',
        };
    }

    /**
     * @return bool
     */
    public function isOperator(): bool
    {
        return AuthorityType::Operator === $this;
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return AuthorityType::Administrator === $this;
    }

    /**
     * @return bool
     */
    public function isUniquestAdministrator(): bool
    {
        return AuthorityType::UniquestAdministrator === $this;
    }
}
