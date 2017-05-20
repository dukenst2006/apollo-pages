<?php

use Weerd\ApolloPages\Models\ApolloPage;

class PagesTest extends TestCase
{
    /** @test */
    public function it_can_do_some_action()
    {
        // Test code here.

        $page = ApolloPage::create([
            'slug' => 'something',
            'path' => '/something',
            'parent_id' => null,
            'tier' => 1,
            'title' => 'Something Title',
            'body' => 'stuff',
        ]);

        dump(ApolloPage::all());
    }
}
