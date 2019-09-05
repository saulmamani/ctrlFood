<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDetailRequest;
use App\Http\Requests\UpdateDetailRequest;
use App\Repositories\DetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DetailController extends AppBaseController
{
    /** @var  DetailRepository */
    private $detailRepository;

    public function __construct(DetailRepository $detailRepo)
    {
        $this->detailRepository = $detailRepo;
    }

    /**
     * Display a listing of the Detail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $details = $this->detailRepository->all();

        return view('details.index')
            ->with('details', $details);
    }

    /**
     * Show the form for creating a new Detail.
     *
     * @return Response
     */
    public function create()
    {
        return view('details.create');
    }

    /**
     * Store a newly created Detail in storage.
     *
     * @param CreateDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateDetailRequest $request)
    {
        $input = $request->all();

        $detail = $this->detailRepository->create($input);

        Flash::success('Detail saved successfully.');

        return redirect(route('details.index'));
    }

    /**
     * Display the specified Detail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detail = $this->detailRepository->find($id);

        if (empty($detail)) {
            Flash::error('Detail not found');

            return redirect(route('details.index'));
        }

        return view('details.show')->with('detail', $detail);
    }

    /**
     * Show the form for editing the specified Detail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detail = $this->detailRepository->find($id);

        if (empty($detail)) {
            Flash::error('Detail not found');

            return redirect(route('details.index'));
        }

        return view('details.edit')->with('detail', $detail);
    }

    /**
     * Update the specified Detail in storage.
     *
     * @param int $id
     * @param UpdateDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDetailRequest $request)
    {
        $detail = $this->detailRepository->find($id);

        if (empty($detail)) {
            Flash::error('Detail not found');

            return redirect(route('details.index'));
        }

        $detail = $this->detailRepository->update($request->all(), $id);

        Flash::success('Detail updated successfully.');

        return redirect(route('details.index'));
    }

    /**
     * Remove the specified Detail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detail = $this->detailRepository->find($id);

        if (empty($detail)) {
            Flash::error('Detail not found');

            return redirect(route('details.index'));
        }

        $this->detailRepository->delete($id);

        Flash::success('Detail deleted successfully.');

        return redirect(route('details.index'));
    }
}
