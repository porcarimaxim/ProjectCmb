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
        $currentUser = Auth::getUser();
        $companyId = $currentUser->company_id;

        $filters = [$this->getModelKeyName() => $id/*, 'company_id' => $companyId*/];
        $parser = ApiHandler::parseSingle($this->getModel(), $filters, []);
        return $parser->getResult();
    }

    public function store(Request $request)
    {
        $currentUser = Auth::getUser();
        $companyId = $currentUser->company_id;
        //$request->replace(['company_id' => $companyId]);
        $model = $this->getModel()->create($request->all());

        return $model;
    }

    public function update(Request $request, $id)
    {
        $model = $this->find($id);

        if ($model) {
            $currentUser = Auth::getUser();
            $companyId = $currentUser->company_id;
            //$request->replace(['company_id' => $companyId]);
            $model = $model->update($request->all());
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

    public function paginate()
    {
        $currentUser = Auth::getUser();
        $parser = ApiHandler::parseMultiple($this->getModel(), [], [/*'company_id' => $currentUser->company_id*/]);
        $builder = $parser->getBuilder();
        $query = $builder->getQuery();
        $total = $query->getCountForPagination();
        $limit = isset($query->limit) ? $query->limit : 25;
        return new LengthAwarePaginator($builder->get(), $total, $limit);
    }
}