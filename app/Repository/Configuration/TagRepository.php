<?php
/**
 * Created by PhpStorm.
 * User: srijan
 * Date: 8/4/17
 * Time: 11:11 AM
 */

namespace App\Repository\Configuration;


use App\Models\Tag;

class TagRepository
{
    /**
     * @var Tag
     */
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function all()
    {
        $tags = $this->tag->orderBy('tag_name','asc')->get();
        return $tags;
    }

    public function findById($id)
    {
        $tag = $this->tag->find($id);
        return $tag;
    }
    public function lists()
    {
        return $this->tag
            ->select('id', 'tag_name')
            ->orderBy('tag_name', 'asc')
            ->get();
    }
    public function searchTag($searchTerm){


        $tag = $this->tag->where('tag_name','LIKE','%'.$searchTerm.'%')->select(['id','tag_name']);

        return $tag;
    }

    public function findTag($id)
    {
        $tag = $this->tag->select('id','tag_name')->find($id);
        return $tag;
    }

}