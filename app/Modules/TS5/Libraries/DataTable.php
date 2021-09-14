<?php
namespace App\Modules\TS5\Libraries;
use Config\Services;

class DataTable
{
    /**
     * retorna los datos de una tabla de acuerdo a los parametros recibidos desde el datatable
     * @param $modelClass
     * @return array
     */
    public function getDataTable($modelClass,$data){
        $model = model($modelClass);

        $columns=$model->allowedFields;
        $model->select($columns);

        $request = service('request');
        $get = $request->getGet();
        $match = $get['search']['value'];
        $h=0;

        if($match<>''){
            foreach($columns as $column){
                if($h==0){
                    $h=1;
                    $model->like($column, $match);
                }else{
                    $model->orLike($column, $match);
                }

            }

        }

        $getColumns = $get['columns'];

        foreach ($get['order'] as $order)
        {
            if ($getColumns[$order['column']]['orderable'] === 'true')
            {
                $num_col=$order['column']-1;
                if($num_col<0){
                    $num_col=0;
                }
                $field=$columns[$num_col];
                $model->orderBy($field, strtoupper($order['dir']));


            }
        }

        $recordsTotal = $model->countAllResults(false);
        $recordsFiltered = $model->countAllResults(false);
        $result= $model->findAll($get['length'],$get['start']);
        $i=0;
        $res=[];
        foreach($result as $value){
            $z=0;
            foreach ($value as $key2 => $value_field){
                if($key2=='id'){
                    $data["value"]=$value_field;
                    $res[$i][$z]=view(('App\Modules\TS5\Views\templates\synadmin\buttons_actions_table2'),$data);
                    $z++;
                }
                $res[$i][$z]=$value_field;
                $z++;
            }

            $i++;
        }

        $response = [
            'draw' => intval($get['draw']),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $res
        ];

        return($response);

    }

    /**
     * versión externa
     * @param $helper
     * @param $modelClass
     * @param $columns
     * @param array $where
     * @return array
     */
    public function process($helper,$modelClass, $columns, $where = [])
	{
	    helper($helper);

        $model = model($modelClass);
        
        foreach ($columns as $column)
        {
            $fields[] = $column['field'];
        }

        $select = implode(', ', $fields);
        
        $model->select($select);

        if (empty($where) === false)
        {
            $model->where($where);
        }

        $request = Services::request();
        $get = $request->getGet();
        $getColumns = $get['columns'];
        
        foreach ($get['order'] as $order)
        {
            if ($getColumns[$order['column']]['orderable'] === 'true')
            {
                $model->orderBy($columns[$order['column']]['field'], strtoupper($order['dir']));
            }
        }
        
        $recordsTotal = $model->countAllResults(false);
        $match = $get['search']['value'];
        
        if (empty($match) === false)
        {
            $count = 0;
            
            foreach ($getColumns as $getColumn)
            {
                if ($getColumn['searchable'] === 'true')
                {
                    $count += 1;
                    $field = $columns[$getColumn['data']]['field'];
                    
                    if ($count === 1)
                    {
                        $model->like($field, $match);
                    }
                    else
                    {
                        $model->orLike($field, $match);
                    }
                }
            }
        }
        
        $recordsFiltered = $model->countAllResults(false);
        
        $model->limit($get['length'], $get['start']);

        $rows = $model->find();

        $data = [];
        
        foreach ($rows as $row)
        {
            $i = 0;
            $d = [];

            foreach ($row as $key => $value)
            {
                $column = $columns[$i];


                if (array_key_exists('action_links', $column) === true)
                {
                    $value = call_user_func($column['action_links'], $value, $row,$key);

                }
                $d[] = $value;
                $i += 1;
            }

            $data[] = $d;
        }
        
        $response = [
            'draw' => intval($get['draw']),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ];

        return $response;
    }

    //--------------------------------------------------------------------
}