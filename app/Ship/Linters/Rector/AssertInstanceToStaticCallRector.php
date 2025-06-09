<?php

declare(strict_types=1);

namespace App\Ship\Linters\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use Rector\PHPUnit\NodeAnalyzer\TestsNodeAnalyzer;
use Rector\Rector\AbstractRector;
use Rector\ValueObject\PhpVersion;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\Exception\PoorDocumentationException;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @implements MinPhpVersionInterface<Node>
 */
final class AssertInstanceToStaticCallRector extends AbstractRector implements MinPhpVersionInterface
{
    /**
     * @var string[]
     */
    private const ASSERT_METHODS = [
        'assertInstanceOf',
        'assertNotInstanceOf',
        'assertContains',
        'assertNotContains',
        'markTestSkipped',
        'assertFalse',
        'assertTrue',
        'assertSame',
        'assertEquals',
        'assertCount',
        'assertNull',
        'assertNotNull',
        'assertEmpty',
        'assertNotEmpty',
        'assertIsString',
        'assertIsArray',
        'assertArrayHasKey',
        'assertArrayNotHasKey',
        'assertDatabaseTable',
    ];

    public function __construct(
        private readonly TestsNodeAnalyzer $testsNodeAnalyzer,
    ) {
    }

    /**
     * @throws PoorDocumentationException
     */
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Changes PHPUnit assertion instance calls like $this->assertInstanceOf() to static calls like self::assertInstanceOf()',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

final class SomeTest extends TestCase
{
    public function test(): void
    {
        $this->assertInstanceOf(Something::class, $object);
        $this->assertTrue($value);
        $this->assertCount(5, $items);
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

final class SomeTest extends TestCase
{
    public function test(): void
    {
        self::assertInstanceOf(Something::class, $object);
        self::assertTrue($value);
        self::assertCount(5, $items);
    }
}
CODE_SAMPLE
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->testsNodeAnalyzer->isInTestClass($node)) {
            return null;
        }

        if (!$this->isName($node->var, 'this')) {
            return null;
        }

        if (!$this->isNames($node->name, self::ASSERT_METHODS)) {
            return null;
        }

        return new StaticCall(
            new Name('self'),
            $this->getName($node->name),
            $node->args
        );
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersion::PHP_82;
    }
}
