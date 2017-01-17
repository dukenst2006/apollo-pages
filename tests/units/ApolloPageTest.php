<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Weerd\ApolloPages\Models\ApolloPage;

class ApolloPageTest extends TestCase
{
    /** @test */
    public function it_returns_a_url_friendly_slug_from_title()
    {
        // Arrange
        $title = 'Example Page Title Here';

        // Act
        $slug = ApolloPage::makeSlug($title);

        // Assert
        $this->assertEquals('example-page-title-here', $slug);
    }

    /** @test */
    public function it_returns_a_url_friendly_slug_from_speicifed_value()
    {
        // Arrange
        $title = 'Example Page Title Here';
        $value = 'Alternate Page Title';

        // Act
        $slug = ApolloPage::makeSlug($title, $value);

        // Assert
        $this->assertEquals('alternate-page-title', $slug);
    }
}
