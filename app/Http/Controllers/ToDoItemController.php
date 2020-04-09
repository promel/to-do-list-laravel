<?php

namespace App\Http\Controllers;
use App\ToDoItem;
use Illuminate\Http\Request;
use App\Http\Resources\ToDoItemResource;
class ToDoItemController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return ToDoItemResource::collection(ToDoItem::with('')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $toDoItem = ToDoItem::create([
        'user_id' => $request->user()->id,
        'title' => $request->title,
        'detail' => $request->detail,
      ]);

      return new ToDoItem($toDoItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ToDoItem $toDoItem)
    {
      return new ToDoItemResource($toDoItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDoItem $toDoItem)
    {
      // check if currently authenticated user is the owner of the book
      if ($request->user()->id !== $toDoItem->user_id) {
        return response()->json(['error' => 'You can only edit your own books.'], 403);
      }

      $toDoItem->update($request->only(['title', 'detail']));

      return new ToDoItemResource($toDoItem);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDoItem $toDoItem)
    {
      $toDoItem->delete();

      return response()->json(null, 204);
    }
}
