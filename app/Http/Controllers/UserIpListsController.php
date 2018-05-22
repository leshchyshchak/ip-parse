<?php

namespace App\Http\Controllers;

use App\UserIpList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserIpListsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'ip' => 'required|min:5',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $request->flash();
            return back()->withErrors($validator)->withInput();
        }

        Auth::user()->ipLists()->create([
            'ip' => $request->ip,
        ]);

        return back()->with('status', 'Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_ip_list = UserIpList::with('ipData')
            ->find($id);

        if ($user_ip_list->user_id == Auth::id()) {
            $paginate_count = 1;

            $user_ip_data = Auth::user()->paginateIpData($paginate_count, $id);

            return view('pages.ip_data.index', compact('user_ip_data'));
        } else
            abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'ip' => 'required|min:5',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $request->flash();
            return back()->withErrors($validator)->withInput();
        }

        Auth::user()->updateIpWithId($id, $request->ip);

        return back()->with('status', 'Edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserIpList::find($id)->delete();

        return back()->with('status', 'Deleted.');
    }
}
