<?php

namespace CodePress\CodeTag\Controllers;

use CodePress\CodeTag\Repository\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class AdminTagController extends Controller {

    private $response;
    private $repository;

    public function __construct(ResponseFactory $response, TagRepository $repository) {
        $this->authorize('access_tags');
        $this->repository = $repository;
        $this->response = $response;
    }

    public function index() {
        $tags = $this->repository->all();
        return $this->response->view("codetag::index", compact('tags'));
    }

    public function create() {
        return view("codetag::create");
    }

    public function store(Request $request) {
        $this->repository->create($request->all());
        return redirect()->route('admin.tags.index');
    }

}
