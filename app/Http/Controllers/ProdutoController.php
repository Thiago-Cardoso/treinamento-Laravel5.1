<?php namespace estoque\Http\Controllers;
use Illuminate\Support\Facades\DB;
use estoque\Produto;
use Request;
use estoque\Http\Requests\ProdutosRequest;

	class ProdutoController extends Controller{


		public function __construct()
		{
			$this->middleware('nosso-middleware',
			['only' => ['adiciona', 'remove']]);
		}


		/*
		public function lista()
		{

			$produtos = DB::select('select * from produtos');

			return view('produto/listagem')->with('produtos', $produtos);
			//return view('listagem')->withProdutos($produtos);
			//return view('listagem', ['produtos' => $produtos]);
		}*/

		//com o Eloquent ORM
		public function lista(){
			$produtos = Produto::all();
			return view('produto.listagem')->with('produtos', $produtos);
		}

		/*
		public function mostra($id){
		// retorna uma view com os detalhes
			$resposta = DB::select('select * from produtos where id = ?',[$id]);

			if(empty($resposta)) {
				return "Esse produto não existe";
			}
			return view('produto/detalhes')->with('p', $resposta[0]);
		}*/

		//com o Eloquent ORM
		public function mostra($id){
			$produto = Produto::find($id);

			if(empty($produto)) {
				return "Esse produto não existe";
			}
			return view('produto.detalhes')->with('p', $produto);
		}

		public function novo()
		{

			return view('produto.formulario');
		}	

		/*
		public function adiciona()
		{
				$nome = Request::input('nome');
				$descricao = Request::input('descricao');
				$valor = Request::input('valor');
				$quantidade = Request::input('quantidade');

				DB::table('produtos')->insert(
				['nome' => $nome,
				'valor' => $valor,
				'descricao' => $descricao,
				'quantidade' => $quantidade]);

				//return view('produto.adicionado')->with('nome',$nome);
				return redirect('/produtos')->withInput(Request::only('nome'));
		}/*


		/*
		public function listaJson(){
			$produtos = DB::select('select * from produtos');
			return $produtos;
		}*/

		/*
		public function listaJson()
		{
			$produtos = DB::select('select * from produtos');
			return response()->json($produtos);
		}*/

		//com o Eloquent ORM
		public function adiciona(ProdutosRequest $request)
		{		
				/*
				$params = Request::all();
				$produto = new Produto($params);
				$produto->save();*/
				Produto::create($request->all());

				return redirect()
					->action('ProdutoController@lista')
					->withInput(Request::only('nome'));
		}


		//com o Eloquent ORM
		public function listaJson(){
			$produtos = Produto::all();
			return response()->json($produtos);
		}


		public function remove($id){
			$produto = Produto::find($id);
			$produto->delete();
			return redirect()
			->action('ProdutoController@lista');
	}


}