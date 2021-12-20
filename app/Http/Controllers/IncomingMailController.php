<?php

namespace App\Http\Controllers;

use App\Models\IncomingMail;
use Illuminate\Http\Request;

class IncomingMailController extends Controller
{
    private $mediaCollection = 'document';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomingMails = IncomingMail::all();

        return view('mail.incoming.index', compact('incomingMails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mail.incoming.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mail_category'     => 'required',
            'mail_number'       => 'required',
            'mail_date'         => 'required',
            'mail_from'         => 'required',
            'mail_information'  => 'required',
            'mail_to'           => 'required',
            'mail_subject'      => 'required'
        ]);

        $mailDate = date('Y-m-d', strtotime($request->mail_date));

        $incomingMail = IncomingMail::create([
            'mail_category'     => $request->mail_category,
            'mail_number'       => $request->mail_number,
            'mail_date'         => $mailDate,
            'mail_from'         => $request->mail_from,
            'mail_information'  => $request->mail_information,
            'mail_to'           => $request->mail_to,
            'mail_subject'      => $request->mail_subject
        ]);

        foreach ($request->input('document', []) as $file) {
            $incomingMail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }

        return redirect()->route('incoming-mail.index')->with('incomingMailMessage', 'Surat Masuk Berhasil Disimpan.');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incomingMail = IncomingMail::with('documents')->find($id);

        return view('mail.incoming.detail', compact('incomingMail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incomingMail = IncomingMail::find($id);
        $documents = $incomingMail->getMedia($this->mediaCollection);

        return view('mail.incoming.form.edit', compact('incomingMail', 'documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $incomingMail = IncomingMail::with('documents')->find($id);

        $mailDate = date('Y-m-d', strtotime($request->mail_date));

        $incomingMail->update([
            'mail_category'     => $request->mail_category,
            'mail_number'       => $request->mail_number,
            'mail_date'         => $mailDate,
            'mail_from'         => $request->mail_from,
            'mail_information'  => $request->mail_information,
            'mail_to'           => $request->mail_to,
            'mail_subject'      => $request->mail_subject
        ]);

        if (count($incomingMail->documents) > 0) {
            foreach ($incomingMail->documents as $media) {
                if (!in_array($media->file_name, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $incomingMail->documents->pluck('file_name')->toArray();

        foreach ($request->input('document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $incomingMail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }

        return redirect()->route('incoming-mail.index')->with('incomingMailMessage', 'Surat Masuk Berhasil Diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IncomingMail::findOrFail($id)->delete();

        return redirect()->back()->with('incomingMailMessage', 'Surat Masuk Berhasil Dihapus.');
    }
}
