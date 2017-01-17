<?php

namespace Weerd\ApolloPages\Models;

use Illuminate\Database\Eloquent\Model;

class ApolloPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Set the guarded attributes for the model.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Find the specified page by its slug.
     *
     * @param string $slug
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }

    /**
     * Assign page attributes that need to be processed first.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Request
     */
    public static function assignProcessedAttributes($request)
    {
        $request['slug'] = static::makeSlug($request->input('slug'), $request->input('title'));

        $request['path'] = static::makePath($request->input('slug'), $request->input('parent_id'));

        $request['tier'] = static::makeTier($request->input('parent_id'));

        return $request;
    }

    /**
     * Make path based on slug and specified page id if present.
     *
     * @param  string $slug
     * @param  string $parentId
     * @return string
     */
    public static function makePath($slug, $parentId = null)
    {
        $parent = static::where('id', $parentId)->first();

        if ($parent) {
            return $parent->path.'/'.$slug;
        }

        return $slug;
    }

    /**
     * Make slug based on title or specified value.
     *
     * @param  string $value
     * @param  string $title
     * @return string
     */
    public static function makeSlug($title, $value = null)
    {
        if (empty($value)) {
            $value = $title;
        }

        return str_slug($value);
    }

    /**
     * Assign tier attribute based on whether page is nested under a parent page.
     *
     * @param  string $parentId
     * @return int
     */
    public static function makeTier($parentId)
    {
        $parent = static::where('id', $parentId)->first();

        if ($parent) {
            return $parent->tier + 1;
        }

        return 1;
    }

    /**
     * Set the slug for the page.
     *
     * @param  string $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Set the parent id for the page.
     *
     * @param  string $value
     * @return void
     */
    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = empty($value) ? null : $value;
    }
}
