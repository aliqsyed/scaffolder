<?php return '<?php

namespace App\\Http\\Controllers;

use App\\Testuser;
use App\\Http\\Requests\\TestuserRequest;

class TestuserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([\'auth\']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \\Illuminate\\Http\\Response
     */
    public function index()
    {
        $user = auth()->user();

        $testusers = $user->can(\'viewAny\', \'App\\Testuser\') ?
            Testuser::with(\'user\')->latest()->get() :
            Testuser::with(\'user\')->where(\'user_id\', $user->id)->latest()->get();

        return view(\'testuser.index\', compact(\'testusers\'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \\Illuminate\\Http\\Response
     */
    public function create()
    {
        $testuser = new Testuser();

        return view(
            \'testuser.create\',
            [
                \'testuser\' => $testuser,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \\Illuminate\\Http\\Request  $request
     * @return \\Illuminate\\Http\\Response
     */
    public function store(TestuserRequest $request)
    {
        $validated = $request->validated();
        $testuser = $request->user()->testusers()->create($validated);

        return redirect(route(\'testuser.index\'))->with(
            \'status\',
            \'Your testuser request was submitted successfully.\'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \\App\\Testuser  $testuser
     * @return \\Illuminate\\Http\\Response
     */
    public function show(Testuser $testuser)
    {
        return view(\'testuser.show\', compact(\'testuser\'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \\App\\Testuser  $testuser
     * @return \\Illuminate\\Http\\Response
     */
    public function edit(Testuser $testuser)
    {
        $this->authorize(\'update\', $testuser);

        return view(
            \'testuser.edit\',
            [
                \'testuser\' => $testuser,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \\Illuminate\\Http\\Request  $request
     * @param  \\App\\Testuser  $testuser
     * @return \\Illuminate\\Http\\Response
     */
    public function update(TestuserRequest $request, Testuser $testuser)
    {
        $validated = $request->validated();
        $testuser->update($validated);

        return redirect(route(\'testuser.index\'))->with(
            \'status\',
            \'The testuser request was updated successfully.\'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \\App\\Testuser  $testuser
     * @return \\Illuminate\\Http\\Response
     */
    public function destroy(Testuser $testuser)
    {
        $this->authorize(\'update\', $testuser);

        $testuser->delete();

        return redirect(route(\'testuser.index\'))->with(\'status\', \'The testuser request was deleted successfully.\');
    }
}
';
