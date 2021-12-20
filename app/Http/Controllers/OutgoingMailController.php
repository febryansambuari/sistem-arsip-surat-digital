<?php

namespace App\Http\Controllers;

use App\Models\OutgoingMail;
use Illuminate\Http\Request;

class OutgoingMailController extends Controller
{
    private $mediaCollection = 'document';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outgoingMails = OutgoingMail::all();

        return view('mail.outgoing.index', compact('outgoingMails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mail.outgoing.form.create');
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
            'mail_category'         => 'required',
            'mail_number'           => 'required',
            'mail_date'             => 'required',
            'mail_from'             => 'required',
            'mail_to'               => 'required',
            'mail_subject'          => 'required',
            'mail_incoming_date'    => 'required'
        ]);

        $mailDate = date('Y-m-d', strtotime($request->mail_date));
        $incomingDate = date('Y-m-d', strtotime($request->mail_incoming_date));

        $outgoingMail = OutgoingMail::create([
            'mail_category'         => $request->mail_category,
            'mail_number'           => $request->mail_number,
            'mail_date'             => $mailDate,
            'mail_from'             => $request->mail_from,
            'mail_to'               => $request->mail_to,
            'mail_subject'          => $request->mail_subject,
            'mail_incoming_date'    => $incomingDate
        ]);

        foreach ($request->input('document', []) as $file) {
            $outgoingMail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }

        return redirect()->route('outgoing-mail.index')->with('outgoingMailMessage', 'Surat keluar Berhasil Disimpan.');
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
        $outgoingMail = OutgoingMail::with('documents')->find($id);

        return view('mail.outgoing.detail', compact('outgoingMail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outgoingMail = OutgoingMail::find($id);
        $documents = $outgoingMail->getMedia($this->mediaCollection);

        return view('mail.outgoing.form.edit', compact('outgoingMail', 'documents'));
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
        $outgoingMail = OutgoingMail::with('documents')->find($id);

        $mailDate = date('Y-m-d', strtotime($request->mail_date));
        $incomingDate = date('Y-m-d', strtotime($request->mail_incoming_date));

        $outgoingMail->update([
            'mail_category'         => $request->mail_category,
            'mail_number'           => $request->mail_number,
            'mail_date'             => $mailDate,
            'mail_from'             => $request->mail_from,
            'mail_to'               => $request->mail_to,
            'mail_subject'          => $request->mail_subject,
            'mail_incoming_date'    => $incomingDate,
        ]);

        if (count($outgoingMail->documents) > 0) {
            foreach ($outgoingMail->documents as $media) {
                if (!in_array($media->file_name, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }

        $media = $outgoingMail->documents->pluck('file_name')->toArray();

        foreach ($request->input('document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $outgoingMail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }

        return redirect()->route('outgoing-mail.index')->with('outgoingMailMessage', 'Surat Keluar Berhasil Diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OutgoingMail::findOrFail($id)->delete();

        return redirect()->back()->with('outgoingMailMessage', 'Surat Keluar Berhasil Dihapus.');
    }
}
