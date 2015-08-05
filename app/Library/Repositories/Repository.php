<?php namespace App\Library\Repositories;

use App\Http\Requests\Request;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Marcelgwerder\ApiHandler\Facades\ApiHandler;

abstract class Repository
{

    /**
     * The base eloquent model
     * @var Eloquent
     */
    protected $model;


    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract function getModel();

    public function getAll()
    {
        //TODO nu e corect
        $parser = ApiHandler::parseMultiple($this->getModel(), []);
        return $parser->getResult();
    }

    public function find($id)
    {
        $parser = ApiHandler::parseSingle($this->getModel(), $id);
        return $parser->getResult();
    }

    public function store(Request $request)
    {
        $model = $this->getModel()->create($request->all());

        return $model;
    }

    public function update(Request $request, $id)
    {
        $model = $this->getModel()->updateOrCreate(['id' => $id], $request->all());
        return $model;
    }

    public function destroy($id)
    {
        $result = $this->getModel()->destroy($id);
        return $result;
    }

    public function paginate()
    {
        $currentUser = Auth::getUser();
        $parser = ApiHandler::parseMultiple($this->getModel(), [], ['company_id' => $currentUser->company_id]);
        $builder = $parser->getBuilder();
        $query = $builder->getQuery();
        $total = $query->getCountForPagination();
        $limit = isset($query->limit) ? $query->limit : 25;
        return new LengthAwarePaginator($builder->get(), $total, $limit);
    }
}