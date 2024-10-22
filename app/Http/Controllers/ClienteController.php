<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Localizacao;
use App\Models\Historico;
use App\Models\Interacao;
   
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    //view
    public function cadastro(){
        return view('cadastro.criar');
    }

    public function inserir(Request $request)
    {
    
        $request->validate([
            'nomesobrenome' => 'required|string|max:255',
            'apelido' => 'nullable|string|max:50',
            'CPF' => 'required|string|max:14|unique:cliente',
            'idade' => 'required',
            'email' => 'required|string|email|max:255|unique:cliente',
            'senha' => 'required|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cep'=> 'required|string|max:10',
            'cidade'=> 'required|string|max:50',
            'estado'=> 'required|in:AC,AL,AM,AP,BA,CE,DF,ES,GO,MA,MG,MS,MT,PA,PB,PE,PI,PR,RJ,RN,RO,RR,RS,SC,SE,SP,TO',
        ]);

        if ($request->fails()) {
            // Se a validação falhar, redireciona com os erros
            return redirect()->back()
                ->withErrors($request)
                ->withInput();
        }

        // Pega a imagem
        $image = $request->file('foto');
        $imagePath = public_path('uploads');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        // Redimensiona a imagem
        $this->resizeImage($image, 150, 150, $imagePath . '/' . $imageName);
        
        $cliente = Cliente::create([
            'nomesobrenome' => $request->nomesobrenome,
            'apelido' => $request->apelido,
            'CPF' => $request->CPF,
            'idade' => $request->idade,
            'email' => $request->email,
            'senha' => $request->senha,
            'foto' => 'uploads/' . $imageName,
        ]);
        
        Auth::login($cliente);
        $id=Auth::user()->id_cliente;
        
        $localizacao=Localizacao::create([
            'id_cliente'=> $cliente->id_cliente,
            'cep' => $request->cep,
            'cidade'=> $request->cidade,
            'estado'=> $request->estado,
        ]);
        return redirect()->route('welcome')->with('success', 'Cliente cadastrado com sucesso!');
    }

    private function resizeImage($image, $width, $height, $destination)
    {
        list($originalWidth, $originalHeight) = getimagesize($image);
        $aspectRatio = $originalWidth / $originalHeight;

        if ($width / $height > $aspectRatio) {
            $newWidth = $height * $aspectRatio;
            $newHeight = $height;
        } else {
            $newHeight = $width / $aspectRatio;
            $newWidth = $width;
        }

        $source = imagecreatefromstring(file_get_contents($image));
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($resizedImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

        switch ($image->getClientOriginalExtension()) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($resizedImage, $destination);
                break;
            case 'png':
                imagepng($resizedImage, $destination);
                break;
            case 'gif':
                imagegif($resizedImage, $destination);
                break;
        }

        imagedestroy($source);
        imagedestroy($resizedImage);
    }
    
    public function editProfile()
    {
        $cliente = Auth::user();
        $localizacao= Localizacao::where('id_cliente','=', $cliente->id_cliente)->first();
        return view('perfil.editar',compact('cliente', 'localizacao'));
    }

    public function updateProfile(Request $request){
        $cliente = Cliente::find(auth()->id());
        $localizacao= Localizacao::where('id_cliente','=', $cliente->id_cliente)->first();
        
        $request->validate([
            'nomesobrenome' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cep'   => 'nullable|string|max:9',
            'estado' => 'nullable|string|max:50',
            'cidade'=> 'nullable|string|max:50',
            'apelido'=> 'nullable|string|max:50',
        ]);


        $cliente->update([
            'nomesobrenome'=> $request-> nomesobrenome,
            'email'=> $request-> email,
            'apelido'=> $request->apelido,
        ]);

        if ($localizacao) {
            $localizacao->update([
                'cep'=> $request-> cep,
                'cidade'=> $request-> cidade,
                'estado'=> $request-> estado,
                ]);
        }
        
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $cliente->foto = basename($path);
            $cliente->save();
        }

        return redirect()->route('perfil.usuario');
    }
    public function perfil() {
        if(auth()->check()) {
            $cliente = Auth::user();
            // Obtendo os históricos associados ao cliente
            $interacoes = Interacao::where('id_cliente', '=', $cliente->id_cliente)->get(); 
            return view('perfil.usuario', compact('cliente','interacoes'));
        }
    }
    
    public function delete($id_interacao){
        if(auth()->check()) {
            $interacao = Interacao::findOrFail($id_interacao);
            $interacao->delete();
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function favoritar(Request $request){
        
        if(auth()->check()) {
            $cliente = Auth::user();
            $idCandidato = $request->input('idCandidato');
            $act= $request->input('acao');
            if(!Candidato::find($idCandidato)) {
                $candidato=Candidato::create([
                    'id_candidato'=> $idCandidato,
                ]);
            }

            
            if($act==='branco' ) {
                $existe = Interacao::where('id_cliente',$cliente->id_cliente)->where('id_candidato',$idCandidato)->exists();
                if(!$existe) {
                    $interacao= Interacao::create([
                    'id_candidato'=> $idCandidato,
                    'id_cliente' => $cliente->id_cliente,
                    'tipo'=> $act,
                    ]);
                    return redirect()->back();
                }else{
                    $errors = ['custom_error' => 'Candidato ja favoritado'];
                    return redirect()->back()->withErrors($errors);
                }
                
            }
        }
        
        return redirect()->back();
    }
}
