<?php namespace App\Library\Repositories;

use App\Http\Requests\Request;
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
     * The authenticated user company_id
     * @var Integer
     */
    protected $companyId;


    /**
     * get model key name
     * return String
     */
    private function getModelKeyName()
    {
        return $this->getModel()->getKeyName();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract function getModel();

    public function find($id)
    {
        $filters = [$this->getModelKeyName() => $id];
        $parser = ApiHandler::parseSingle($this->getModel(), $filters, []);
        return $parser->getResult();
    }

    public function store(Request $request)
    {
        $model = $this->getModel()->create($request->all());
        return $model;
    }

    public function update(Request $request, $id)
    {
        $model = $this->find($id);

        if ($model) {
            $model->update($request->all());
        }

        return $model;
    }

    public function destroy($id)
    {
        $model = $this->find($id);
        $result = false;
        if ($model) {
            $result = $model->delete();
        }
        return $result;
    }

    public function paginate( $filters = [] )
    {
        $parser = ApiHandler::parseMultiple($this->getModel(), [], $filters);
        $builder = $parser->getBuilder();
        $query = $builder->getQuery();
        $total = $query->getCountForPagination();
        $limit = isset($query->limit) ? $query->limit : 25;
        return new LengthAwarePaginator($builder->get(), $total, $limit);
    }
}