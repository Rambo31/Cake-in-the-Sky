<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Article;
use Authorization\IdentityInterface;

/**
 * Article policy
 */
class ArticlePolicy
{
    /**
     * Check if $account can add Article
     *
     * @param \Authorization\IdentityInterface $account The account.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canAdd(IdentityInterface $account, Article $article)
    {
        // All logged in accounts can create articles.
        return true;
    }

    /**
     * Check if $account can edit Article
     *
     * @param \Authorization\IdentityInterface $account The account.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canEdit(IdentityInterface $account, Article $article)
    {
        // logged in accounts can edit their own articles.
        return $this->isAuthor($account, $article);
    }

    /**
     * Check if $account can delete Article
     *
     * @param \Authorization\IdentityInterface $account The account.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canDelete(IdentityInterface $account, Article $article)
    {
        // logged in accounts can delete their own articles.
        return $this->isAuthor($account, $article);
    }

    protected function isAuthor(IdentityInterface $account, Article $article): bool
    {
        return $article->account_id === $account->getIdentifier();
    }
}
