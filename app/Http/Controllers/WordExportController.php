<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class WordExportController extends Controller
{
    public function exportToWord()
    {
        
        // Foydalanuvchi yoki boshqa manbalardan hisob-faktura uchun ma'lumotlar olish
        $invoiceData = [
            'invoice_number' => 'INV-1001',
            'date' => now()->format('d-m-Y'),
            'customer_name' => 'John Doe',
            'customer_address' => '123 Main Street, City, Country',
            'items' => [
                ['description' => 'T-Shirt', 'quantity' => 2, 'price' => 15.00],
                ['description' => 'Laptop Stand', 'quantity' => 1, 'price' => 30.00],
                ['description' => 'Wireless Mouse', 'quantity' => 3, 'price' => 7.50],
            ],
            'subtotal' => 150.00,
            'tax' => 18.00,
            'total' => 168.00
        ];
        $htmlContent = View::make('example', $invoiceData)->render();
        // PHPWord ob'ektini yaratish
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        // Hisob-faktura sarlavhasi
        $section->addTitle('Hisob-Faktura', 1);

        $style = new \PhpOffice\PhpWord\Style\Paragraph();
        $style->setAlignment(\PhpOffice\PhpWord\SimpleType\Jc::CENTER); // Markazlashtirish
        // Hisob-faktura raqami va sana
        $section->addText("Hisob-faktura raqami: " . $invoiceData['invoice_number'],null,$style);
        $section->addText("Sana: " . $invoiceData['date']);

        // Mijoz ma'lumotlari
        $section->addText("Mijoz: " . $invoiceData['customer_name']);
        $section->addText("Manzil: " . $invoiceData['customer_address']);

        // Mahsulotlar jadvali
        $section->addText('Mahsulotlar:');
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(4000)->addText('Tavsif');
        $table->addCell(2000)->addText('Miqdori');
        $table->addCell(2000)->addText('Narxi');
        $table->addCell(2000)->addText('Jami');

        foreach ($invoiceData['items'] as $item) {
            $table->addRow();
            $table->addCell(4000)->addText($item['description']);
            $table->addCell(2000)->addText($item['quantity']);
            $table->addCell(2000)->addText(number_format($item['price'], 2));
            $table->addCell(2000)->addText(number_format($item['quantity'] * $item['price'], 2));
        }

        // Yig'indilar va soliq
        $section->addText('Yig\'indi: ' . number_format($invoiceData['subtotal'], 2));
        $section->addText('Soliq (18%): ' . number_format($invoiceData['tax'], 2));
        $section->addText('Jami: ' . number_format($invoiceData['total'], 2));

        // Word faylini saqlash
        $fileName = 'invoice_' . $invoiceData['invoice_number'] . '.docx';
        $filePath = storage_path('app/public/invoices/' . $fileName);

        // Faylni saqlash
        $phpWord->save($filePath, 'Word2007');

        // Foydalanuvchiga yuklab olish imkoniyatini berish
        return response()->download($filePath);
    }
}
