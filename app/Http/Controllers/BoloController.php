<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoloRequest;
use App\Http\Requests\UpdateBoloRequest;
use App\Services\BoloService;
use App\Repositories\RepositoryInterface;
use App\Http\Resources\BoloResource;
use Illuminate\Support\Facades\Storage;

class BoloController extends Controller
{
    private $boloService;
    private $boloRepository;

    public function __construct(BoloService $boloService, RepositoryInterface $boloRepository)
    {
        $this->boloService = $boloService;
        $this->boloRepository = $boloRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->boloService->getBolosList();

        if (request()->wantsJson()) {
            return response()->json([
                'bolos' => BoloResource::collection($data['lista_bolos']),
                'favoritos' => $data['favoritos'],
            ]);
        }
    
        return view("app.home_bolo", ['lista_bolos' => $data['lista_bolos'], 'favoritos' => $data['favoritos']] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("app.bolos.cadastro_bolo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoloRequest $request)
    {
        try {         
            $validated = $request->validated();

            if ($request->hasFile('imagem')) {
                $validated['imagem'] = $request->file('imagem')->store('bolos', 'public');
            } else {
                $validated['imagem'] = null;
            }

            $bolo = $this->boloRepository->create($validated);

            if (request()->wantsJson()) {
                return response()->json([
                    'message' => 'Bolo cadastrado com sucesso!',
                    'bolo' => new BoloResource($bolo)
                ], 201); 
            } 

            return redirect()->route('bolo.index')->with('success', 'Bolo cadastrado com sucesso!');  

        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'error' => 'Ocorreu um erro ao cadastrar o bolo. Por favor, tente novamente.'
                ], 500); // Status code 500 para erro interno do servidor
            } 

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocorreu um erro ao cadastrar o bolo. Por favor, tente novamente.');       
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bolo = $this->boloRepository->find($id);

        if (request()->wantsJson()) {
            return response()->json(['bolo' => new BoloResource($bolo)], 200);
        }
    
        return view('app.bolos.show', compact('bolo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bolo = $this->boloRepository->find($id);
        return view('app.bolos.update_bolo', compact('bolo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoloRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoloRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $bolo = $this->boloRepository->find($id);
            
            if ($request->hasFile('imagem')) {
                if ($bolo->imagem) {
                    Storage::disk('public')->delete($bolo->imagem);
                }
                $validated['imagem'] = $request->file('imagem')->store('bolos', 'public');
            }

            $bolo = $this->boloService->updateBoloControleEmailsEstoque($this->boloRepository->find($id), $validated);

            if (request()->wantsJson()) {
                return response()->json([
                    'message' => 'Bolo atualizado com sucesso!',
                    'bolo' => new BoloResource($bolo)
                ], 200);
            }

            return redirect()->route('bolo.index')->with('success', 'Bolo atualizado com sucesso!');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'error' => 'Ocorreu um erro ao atualizar o bolo. Por favor, tente novamente.'
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocorreu um erro ao atualizar o bolo. Por favor, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $bolo = $this->boloRepository->find($id);

            if ($bolo->imagem) {
                Storage::disk('public')->delete($bolo->imagem);
            }

            $this->boloRepository->delete($id);

            if (request()->wantsJson()) {
                return response()->json([
                    'message' => 'Bolo deletado com sucesso!'
                ], 200);
            }

            return redirect()->route('bolo.index')->with('deleted', 'Bolo excluído!');
            
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'error' => 'Erro ao excluir o bolo. Por favor, tente novamente.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Erro ao excluir o bolo. Por favor, tente novamente.');
        }
    }
}