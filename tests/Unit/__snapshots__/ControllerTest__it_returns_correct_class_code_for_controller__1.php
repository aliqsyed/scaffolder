<?php return '<?php

namespace App\\Http\\Controllers;

use App\\Credential;
use App\\Http\\Requests\\CredentialRequest;

class CredentialController extends Controller
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

        $credentials = $user->can(\'viewAny\', \'App\\Credential\') ?
            Credential::with(\'user\')->latest()->get() :
            Credential::with(\'user\')->where(\'user_id\', $user->id)->latest()->get();

        return view(\'credential.index\', compact(\'credentials\'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \\Illuminate\\Http\\Response
     */
    public function create()
    {
        $credential = new Credential();

        return view(
            \'credential.create\',
            [
                \'credential\' => $credential,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \\Illuminate\\Http\\Request  $request
     * @return \\Illuminate\\Http\\Response
     */
    public function store(CredentialRequest $request)
    {
        $validated = $request->validated();
        $credential = $request->user()->credentials()->create($validated);

        return redirect(route(\'credential.index\'))->with(
            \'status\',
            \'Your credential request was submitted successfully.\'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \\App\\Credential  $credential
     * @return \\Illuminate\\Http\\Response
     */
    public function show(Credential $credential)
    {
        return view(\'credential.show\', compact(\'credential\'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \\App\\Credential  $credential
     * @return \\Illuminate\\Http\\Response
     */
    public function edit(Credential $credential)
    {
        $this->authorize(\'update\', $credential);

        return view(
            \'credential.edit\',
            [
                \'credential\' => $credential,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \\Illuminate\\Http\\Request  $request
     * @param  \\App\\Credential  $credential
     * @return \\Illuminate\\Http\\Response
     */
    public function update(CredentialRequest $request, Credential $credential)
    {
        $validated = $request->validated();
        $credential->update($validated);

        return redirect(route(\'credential.index\'))->with(
            \'status\',
            \'The credential request was updated successfully.\'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \\App\\Credential  $credential
     * @return \\Illuminate\\Http\\Response
     */
    public function destroy(Credential $credential)
    {
        $this->authorize(\'update\', $credential);

        $credential->delete();

        return redirect(route(\'credential.index\'))->with(\'status\', \'The credential request was deleted successfully.\');
    }
}
';
