<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Inexport;
use App\Models\InexportItem;
use Illuminate\Http\Request;

class InexportController extends Controller
{
    //
    public function createinexport(Request $request)
    {
        $type = $request->get('type');
        $newinexport = Inexport::create(['type' => $type]);
        $books = $request->get('books');
        if ($books && is_array($books)) {
            foreach ($books as $book) {
                if (is_array($book) && isset($book['book_id']) && isset($book['quantity'])) {
                    InexportItem::create([
                        'inexport_id' => $newinexport->id,
                        'book_id' => $book['book_id'],
                        'quantity' => $book['quantity'],
                    ]);
                }
            }
        }
        return response()->json(['message' => 'sucessfully',], 200);
    }

    public function export()
    {
        $exports = Inexport::where('type', '1')->get();
        // $exports = Inexport::all();
        return response()->json(['message' => 'sucessfully', 'exports' => $exports], 200);
    }

    public function import()
    {
        $imports = Inexport::where('type', '0')->get();
        return response()->json(['message' => 'sucessfully', 'imports' => $imports], 200);
    }

    public function getdetail($id)
    {
        $books = InexportItem::where('inexport_id', $id)->get();
        return response()->json(['message' => 'sucessfully', 'books' => $books], 200);
    }

    public function updatestatus($id, $status)
    {
        $history = Inexport::where('id', $id)->first();
        if ($status == '2') {
            $history->status = '2';
        } else {

            $history->status = '1';
            $books = InexportItem::where('inexport_id', $id)->get();
            if ($history->type == '0') {
                foreach ($books as $book) {
                    $book_id = $book->book_id;
                    $quantity = $book->quantity;
                    $book_item = Book::where('id', $book_id)->first();
                    if ($book_item) {
                        $book_item->count += $quantity;
                    }
                    $book_item->update();
                }
            } else {
                foreach ($books as $book) {
                    $book_id = $book->book_id;
                    $quantity = $book->quantity;
                    $book_item = Book::where('id', $book_id)->first();
                    if ($book_item) {
                        if ($book_item->count - $quantity < 0) {
                            return response()->json(['message' => 'Lack of product',], 500);
                        } else {
                            $book_item->count -= $quantity;
                            $book_item->update();
                        }
                    }
                }
            }
        }
        $history->update();
        return response()->json(['message' => 'Successfully',], 200);
    }
}
