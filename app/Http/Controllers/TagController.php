<?php

namespace App\Http\Controllers;

use App\Material;
use App\Slice;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class TagController.
 */
class TagController extends Controller
{
    /**
     * @param $materialId
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index($materialId)
    {
        $tags = Material::findOrFail($materialId)->tags;
        return response($tags, Response::HTTP_OK);
    }

    /**
     * Returns all tags in system
     * @return Response
     */
    public function list_tag()
    {
        return response(Tag::all(), Response::HTTP_OK);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $materialId
     *
     * @return int
     *
     * @internal param $material
     */
    public function create(Request $request, $materialId)
    {
        $material = Material::findOrFail($materialId);
        $tag = $material->tags()
            ->create($request->all());

        return response($tag, Response::HTTP_CREATED);
    }

    /**
     * @param $materialId
     * @param $tag_id
     * @return mixed
     */
    public function show($tag_id, $materialId)
    {
        $tag = Tag::findOrFail($tag_id);

        return response($tag, Response::HTTP_OK);
    }

    /**
     * @param $materialId
     * @param $tag_id
     * @return int
     * @internal param $sliceId
     *
     * @internal param $id
     */
    public function detach($tag_id, $materialId)
    {
        Material::findOrFail($materialId)->tags()->detach($tag_id);

        return response('', Response::HTTP_OK);
    }

    /**
     * @param $id Integer id of tag for delete
     * @return Response
     */
    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();
        return response('', Response::HTTP_OK);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Integer $tag_id id of tag for update
     * @param $materialId
     * @return int
     * @internal param $modelId
     * @internal param $sliceId
     *
     * @internal param $id
     */
    public function update(Request $request, $tag_id, $materialId)
    {
        Tag::findOrFail($tag_id)
            ->update($request->all());

        $tag = Tag::findOrFail($tag_id);

        return response($tag, Response::HTTP_OK);
    }
}