<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roupa;
use App\Models\User;


class RoupaController extends Controller
{
  public function index()
  {

    $search = request('search');

    if ($search) {
      $roupas = Roupa::where([
        ['tipo', 'like', '%' . $search . '%']
      ])->get();
    } else {
      $roupas = Roupa::all();
    }

    return view(
      'welcome',
      ['roupas' => $roupas, 'search' => $search]
    );
  }

  public function create()
  {
    return view('/roupas/create');
  }

  public function store(Request $request)
  {

    $roupa = new Roupa;

    $roupa->tipo = $request->tipo;
    $roupa->preco = $request->preco;
    $roupa->marca = $request->marca;
    $roupa->tamanhos = $request->tamanhos;
    $roupa->image = $request->image;

    if ($request->hasFile('image') && $request->file('image')->isValid()) {

      $requestImage = $request->image;
      $extension = $requestImage->extension();

      $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

      $requestImage->move(public_path('img/roupas'), $imageName);

      $roupa->image = $imageName;
    }


    $roupa->user_id = auth()->user()->id;
    $roupa->save();

    return redirect('/')->with('msg', 'Peça cadastrada com sucesso!');
  }

  public function show($id)
  {

    $roupa = Roupa::findOrFail($id);

    $user = auth()->user();
    $hasUserJoined = false;

    if ($user) {
      $userRoupas = $user->roupasComprador->toArray();

      foreach ($userRoupas as $userRoupa) {
        if ($userRoupa['id'] == $id) {
          $hasUserJoined = true;
        }
      }
    }
    $roupaOwner = User::where('id', $roupa->user_id)->first()->toArray();

    return  view('/roupas/show', ['roupa' => $roupa, 'hasUserJoined' => $hasUserJoined]);
  }

  public function dashboard()
  {
    $user = auth()->user();

    $roupas = $user->roupas;

    $roupasComprador = $user->roupasComprador;

    return view('/roupas/dashboard', ['roupas' => $roupas, 'roupasComprador' => $roupasComprador]);
  }

  public function wishRoupa($id)
  {
    $user = auth()->user();

    $user->roupasComprador()->attach($id);

    $roupa = Roupa::findOrFail($id);

    return redirect('/dashboard')->with('msg', 'O produto ' . $roupa->tipo . ' foi adicionado à sua wishlist!');
  }

  public function edit($id)
  {

    $user = auth()->user();
    $roupa = Roupa::findOrFail($id);

    if ($user->id != $roupa->user_id) {
      return redirect('/roupas/dashboard');
    }

    return view('roupas/edit', ['roupa' => $roupa]);
  }

  public function update(Request $request)
  {

    $data = $request->all();


    if ($request->hasFile('image') && $request->file('image')->isValid()) {

      $requestImage = $request->image;
      $extension = $requestImage->extension();

      $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

      $requestImage->move(public_path('img/roupas'), $imageName);

      $data['image'] = $imageName;
    }

    Roupa::findOrFail($request->id)->update($data);

    return redirect('/dashboard')->with('msg', 'Roupa editada!');
  }

  public function leaveRoupa($id)
  {
    $user = auth()->user();
    $user->roupasComprador()->detach($id);

    $roupa = Roupa::findOrFail($id);

    return redirect('/dashboard')->with('msg', 'Você removeu o produto: ' . $roupa->tipo . " da sua wishlist");
  }

  public function destroy($id)
  {
    Roupa::findOrFail($id)->delete();

    return redirect('/dashboard')->with('msg', 'Roupa excluída!');
  }
}
