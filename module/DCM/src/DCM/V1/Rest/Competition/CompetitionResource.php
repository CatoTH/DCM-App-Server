<?php
namespace DCM\V1\Rest\Competition;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class CompetitionResource extends AbstractResourceListener
{
	/** @var CompetitionStorageMapper $storageMapper */
	protected $storageMapper;

	/**
	 * @param CompetitionStorageMapper $storageMapper
	 */
	public function __construct($storageMapper)
	{
		$this->storageMapper = $storageMapper;
	}


	/**
	 * @return int
	 */
	protected function getCurrentGroupId() {
		return $this->getEvent()->getRouteMatch()->getParam("group_id");
	}

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
		if (property_exists($data, "id")) {
			return $this->storageMapper->updateItem(CompetitionEntity::fromArray($data));
		} else {
			return $this->storageMapper->insertItem(CompetitionEntity::fromArray($data));
		}
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
		return $this->storageMapper->getItem($this->getCurrentGroupId(), $id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
		$group_id = $this->getCurrentGroupId();
		$adapter = new CompetitionPaginatorAdapter($this->storageMapper, $group_id);
		$collection = new CompetitionCollection($adapter);
		return $collection;
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
