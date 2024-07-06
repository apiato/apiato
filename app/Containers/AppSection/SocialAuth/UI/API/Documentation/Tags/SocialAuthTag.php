<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Documentation\Tags;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use MohammadAlavi\LaravelOpenApi\Factories\TagFactory;

class SocialAuthTag extends TagFactory
{
    public function build(): Tag
    {
        return Tag::create()
            ->name('SocialAuth')
            ->description('Social Authentication operations');
    }
}
