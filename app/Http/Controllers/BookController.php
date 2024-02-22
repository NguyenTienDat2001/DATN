<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //get all book
    public function getAllbook()
    {
        $books = Book::all();
        return response()->json(['message' => 'success', 'books' => $books], 200);
    }

    public function getBook($id)
    {
        $book = Book::where('id', $id)->first();
        return response()->json(['message' => 'success', 'data' => $book], 200);
    }

    public function addBook(Request $request)
    {
        // $newbook = $request->all();
        // $arrayData = json_decode($jsonData, true);
        // return json_decode($request->all, true);
        $book = Book::where("name", $request->name)->first();
        if ($book) {
            return response()->json(['message' => 'duplicate book',], 500);
        } else {
            $newbook = Book::create([
                "name" => $request->name,
                "description" => $request->description,
                "category" =>  $request->category,
                "buy_price" =>  $request->buy_price,
                "sell_price" => $request->sell_price,
                "author" => $request->author,
                "age" => $request->age,
                "published_at" => $request->published_at,
                "publisher" => $request->publisher,
                "count" => $request->count,
                "totalsale" => $request->totalsale,
                "img" => $request->img,
            ]);
            return response()->json(['message' => 'sucess', 'newbook' => $newbook], 200);
        }
    }

    public function deleteBook($book_id)
    {
        $bookitem = Book::where('id', $book_id)->first();
        $bookitem->delete();
        return response()->json([
            'status' => 200,
            'message' => 'delete sucessfully',
        ]);
    }

    public function searchBook(Request $request)
    {
        $cate = $request->get('cate');
        $age = $request->get('age');
        $price = $request->get('price');
        $book_name = $request->get('book_name');
        if ($book_name) {
            $books = Book::where('name', 'LIKE', '%' . $book_name . '%')->first();
            return response()->json(['message' => 'sucess', 'books' => $books], 200);
        } else {
            $books = Book::query();
            if ($cate != '0') {
                $books = $books->where('category', 'LIKE', $cate);
            }
            if ($age != '0') {
                $books = $books->where('age', $age);
            }
            if ($price != '0') {
                // $price = $books->where('category', $price);
                switch ($price) {
                    case '1':
                        $price = $books->where('sell_price', '<', 50000);
                        break;
                    case '2':
                        $price = $books->where('sell_price', '>=', 50000)->where('sell_price', '<', 100000);
                        break;
                    case '3':
                        $price = $books->where('sell_price', '>=', 100000)->where('sell_price', '<', 200000);
                        break;
                    case '4':
                        $price = $books->where('sell_price', '>=', 200000)->where('sell_price', '<', 400000);
                        break;
                    case '5':
                        $price = $books->where('sell_price', '>=', 400000)->where('sell_price', '<', 1000000);
                        break;
                    case '6':
                        $price = $books->where('sell_price', '>=', 1000000);
                        break;

                    default:
                        # code...
                        break;
                }
            }
            $books = $books->get();
            return response()->json(['message' => 'sucess', 'books' => $books], 200);

        }
    }
}
