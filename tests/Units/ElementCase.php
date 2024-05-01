<?php

namespace MMX\Database\Tests\Units;

use MMX\Database\Models\Source;
use MMX\Database\Models\Traits\StaticElement;
use PHPUnit\Framework\TestCase;

abstract class ElementCase extends TestCase
{
    protected string $name = 'mmxDatabaseElementTest';
    protected string $content = 'Hello World';
    protected string $contentField = 'content';
    protected string $nameField = 'name';

    public function testCreate(): void
    {
        /** @var StaticElement $element */
        $element = new $this->model([
            $this->nameField => $this->name,
            $this->contentField => '',
            'properties' => [],
        ]);
        $element->save();

        $this->assertIsArray($element->properties);
        $this->assertEquals(1, $element->newQuery()->where($this->nameField, $this->name)->count());
    }

    public function testFileCreate(): void
    {
        /** @var Source $source */
        if (!$source = Source::query()->where('class_key', 'LIKE', '%modFileMediaSource')->first()) {
            return;
        }

        $base = $source->getBasePath();
        $tempnam = tempnam($base, 'test_element_');
        file_put_contents($tempnam, $this->content);

        /** @var StaticElement $element */
        $element = $this->model::query()->where($this->nameField, $this->name)->first();
        $this->assertNotNull($element);

        $element->source = $source->id;
        $element->static = true;
        $element->static_file = str_replace($base, '', $tempnam);
        $element->save();

        $this->assertSame($element->getContent(), $this->content);
    }

    public function testFileDelete(): void
    {
        /** @var StaticElement $element */
        $element = $this->model::query()->where($this->nameField, $this->name)->first();
        $this->assertNotNull($element);
        $this->assertTrue($element->deleteStaticFile());

        $element->refresh();

        $this->assertFalse($element->static);
        $this->assertEquals('', $element->static_file);
        $this->assertEquals('', $element->getContent());
    }

    public function testDelete(): void
    {
        $this->assertEquals(1, $this->model::query()->where($this->nameField, $this->name)->delete());
    }
}