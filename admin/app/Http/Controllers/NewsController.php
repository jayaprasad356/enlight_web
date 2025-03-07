<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function edit()
    {
        $news = News::find(1); // Ensure it retrieves the record with ID 1
        if (!$news) {
            return redirect()->route('news.edit')->withErrors('News record not found.');
        }
        return view('news.edit', compact('news'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'telegram_link' => 'required|string',
            'customer_support_number' => 'required|string',
            'zoho_chat_link' => 'required|string',
            'minimum_withdrawals' => 'required|string',
            'whatsapp_status_income' => 'required|string',
            'download_today_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news = News::find(1);
        if (!$news) {
            return redirect()->route('news.edit')->withErrors('News record not found.');
        }

        // Handling image upload for 'download_today_image'
        if ($request->hasFile('download_today_image')) {
            if ($news->download_today_image) {
                Storage::disk('public')->delete($news->download_today_image);
            }
            $news->download_today_image = $request->file('download_today_image')->store('news', 'public');
        }

        // Handling image upload for 'qr_image'
        if ($request->hasFile('qr_image')) {
            if ($news->qr_image) {
                Storage::disk('public')->delete($news->qr_image);
            }
            $news->qr_image = $request->file('qr_image')->store('qr_image', 'public');
        }

        // Updating other fields
        $news->telegram_link = $request->input('telegram_link');
        $news->customer_support_number = $request->input('customer_support_number');
        $news->zoho_chat_link = $request->input('zoho_chat_link');
        $news->minimum_withdrawals = $request->input('minimum_withdrawals');
        $news->whatsapp_status_income = $request->input('whatsapp_status_income');
        $news->save();

        return redirect()->route('news.edit')->with('success', 'Settings updated successfully.');
    }
}
