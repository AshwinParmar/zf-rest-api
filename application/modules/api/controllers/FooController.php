<?php
/**
 *  Sample Foo Resource
 */
class Api_FooController extends REST_Controller
{
    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
	 * curl http://zf-angular.local:90/api/foo
     */
    public function indexAction()
    {
        $this->view->message = 'Listing of all values.';
		
		try {
			$db = Zend_Db_Table::getDefaultAdapter();
			$select = $db->select(TRUE);
			$select->from( array('f' => 'foo') );
			$result = $db->fetchAll($select);
			$this->view->results = $result;
			$this->view->total = count($result);
		}
		catch(Exception $e) {
			$this->view->message = sprintf('Error: %s', $e->getMessage());
		}
		
        $this->_response->ok();
    }

    /**
     * The head action handles HEAD requests; it should respond with an
     * identical response to the one that would correspond to a GET request,
     * but without the response body.
	 * curl -X HEAD http://zf-angular.local:90/api/foo/head
     */
    public function headAction()
    {
        $this->view->message = 'headAction has been called';
        $this->_response->ok();
    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
	 * curl -X GET http://zf-angular.local:90/api/foo/id
     */
    public function getAction()
    {
	
        $id = $this->_getParam('id', 0);

        $this->view->id = $id;
		
		try {
			$db = Zend_Db_Table::getDefaultAdapter();
			$select = $db->select(TRUE);
			$select->from( array('f' => 'foo') )->where('f.id = ?', $id);
			$result = $db->fetchAll($select);
			$this->view->results = $result;
		}
		catch(Exception $e) {
			$this->view->message = sprintf('Error: %s', $e->getMessage());
		}
		
		
        //$this->view->message = sprintf('Resource #%s', $id);
        $this->_response->ok();
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
	 * curl -X POST http://zf-angular.local:90/api/foo
     */
    public function postAction()
    {
        $this->view->params = $this->_request->getParams();
        
		try {
			$id = $this->_request->getParam('id');
			$name = $this->_request->getParam('name');
			$value = $this->_request->getParam('value');
			
			$data = array('name' => $name, 'value' => $value);
			//$where[] = "id = '$id'";
			//$where['id = ?'] = $id;
			
			$db = Zend_Db_Table::getDefaultAdapter();
			/*$id = $db->update('foo', $data, $where);
			$this->view->message = sprintf("'%s' updated!", $id);*/
			$db->insert('foo', $data);
			$id = $db->lastInsertId();
			$this->view->message = sprintf("Resource '%s' (%s) Created!", $name, $id);
		}
		catch(Exception $e) {
			$this->view->message = sprintf('Error: %s', $e->getMessage());
		}
		
        $this->_response->created();
    }

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
	 * curl -X PUT http://zf-angular.local:90/api/foo/id/1
     */
    public function putAction()
    {
        $id = $this->_getParam('id', 0);

		try {
			$id = $this->_request->getParam('id');
			$name = $this->_request->getParam('name');
			$value = $this->_request->getParam('value');
			if(isset($name) && isset($value)) {
				$data = array('name' => $name, 'value' => $value);
				//$where[] = "id = '$id'";
				$where['id = ?'] = (int) $id;
				
				$db = Zend_Db_Table::getDefaultAdapter();
				$id = $db->update('foo', $data, $where);
				$this->view->message = sprintf('Resource #%s Updated', $id);				
			}
			else {
				throw new REST_Exception("Invalid arguments provided");
			}
		}
		catch(Exception $e) {
			$this->view->message = sprintf('Error: %s', $e->getMessage());
		}
		
        $this->_response->ok();
    }

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
	 * curl -X DELETE http://zf-angular.local:90/api/foo/id/1
     */
    public function deleteAction()
    {
        $id = $this->_getParam('id', 0);
		$this->view->id = $id;
		try {
			//$id = $this->_request->getParam('id');
			if(isset($id)) {
				$where['id = ?'] = (int) $id;
				$db = Zend_Db_Table::getDefaultAdapter();
				$id = $db->delete('foo', $where);
				$this->view->message = sprintf('Resource #%s Deleted', $id);
			}
			else {
				throw new REST_Exception("Invalid arguments provided");
			}
		}
		catch(Exception $e) {
			$this->view->message = sprintf('Error: %s', $e->getMessage());
		}
        $this->_response->ok();
    }
}
