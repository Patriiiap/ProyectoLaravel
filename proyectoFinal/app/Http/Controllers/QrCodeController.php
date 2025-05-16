<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image as InterventionImage;
use Intervention\Image\Laravel\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;

class QrCodeController extends Controller
{
    public function index()
    {
        $qrCodes = QrCode::latest()->paginate(10);
        return view('qrcodes.index', compact('qrCodes'));
    }

    public function create()
    {
        return view('qrcodes.create');
    }

    public function generarQR(string $id){
        // Buscar la cita en la base de datos
        $citaController = new CitaController();
        $cita = $citaController->getCita($id);
        
        // Datos que quieres incluir en el QR (ajusta según tus necesidades)
        $qrData = [
            'id' => $cita->id,
            'fecha_inicio' => $cita->fecha_inicio,
            'fecha_fin' => $cita->fecha_fin,
            'id_profesional' => $cita->id_profesional,
            'id_usuario' => $cita->id_usuario,
            'token' => $this->generarTokenCita($cita) // Token de seguridad
        ];
        // Convertir a JSON (o al formato que prefieras)
        $qrContent = json_encode($qrData);
        
        // Pasar datos a la vista
        return view('qrcodes.create', [
            'cita' => $cita,
            'qrContent' => $qrContent
        ]);
    
    }

    private function generarTokenCita($cita)
    {
        // Crear un string único con los datos principales de la cita
        $dataStr = $cita->id . $cita->profesional_id . $cita->usuario_id . $cita->fecha_inicio;
        
        // Generar un hash como token (puedes usar una clave secreta de la app)
        return hash('sha256', $dataStr . config('app.key'));
    }

    public function scan(string $id)
    {
         // Buscar la cita en la base de datos
         $citaController = new CitaController();
         $cita = $citaController->getCita($id);
         
        return view('qrcodes.scan', [
            'cita' => $cita
        ]);
    }

    public function escanearQR(string $id){
        // Buscar la cita en la base de datos
        $citaController = new CitaController();
        $cita = $citaController->getCita($id);
        
        // Datos que quieres incluir en el QR (ajusta según tus necesidades)
        $qrData = [
            'id' => $cita->id,
            'fecha_inicio' => $cita->fecha_inicio,
            'fecha_fin' => $cita->fecha_fin,
            'id_profesional' => $cita->id_profesional,
            'id_usuario' => $cita->id_usuario,
        ];
        // Convertir a JSON (o al formato que prefieras)
        $qrContent = json_encode($qrData);
        
        // Pasar datos a la vista
        return view('qrcodes.create', [
            'cita' => $cita,
            'qrContent' => $qrContent
        ]);
    
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'qr_image' => 'required|image|max:2048',
    //         'type' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);

    //     // Procesar la imagen subida
    //     $image = Image::read($request->file('qr_image'));
    //     $image = Image::make($request->file('qr_image'));
        
    //     // Guardar la imagen temporalmente para procesarla
    //     $tempPath = storage_path('app/temp/qr-temp.png');
    //     Storage::makeDirectory('temp');
    //     $image->save($tempPath);

    //     // Intentar leer el código QR usando una biblioteca de terceros
    //     try {
    //         // Necesitarás usar una biblioteca específica para leer/decodificar QR
    //         // Este es un ejemplo usando una clase ficticia QrReader
    //         // En un proyecto real, podrías usar la biblioteca ZBar o similar
    //         // $reader = new \QrReader($tempPath);
    //         // $content = $reader->text();
            
    //         // Como SimpleSoftwareIO/simple-qrcode no tiene un lector de QR incorporado,
    //         // simulamos la lectura para este ejemplo
    //         // En un proyecto real, usa una biblioteca específica para esta tarea
            
    //         // Usamos una biblioteca ficticia para la demostración
    //         $content = $this->simulateQrReading($tempPath);
            
    //         if (!$content) {
    //             return back()->with('error', 'No se pudo detectar un código QR válido en la imagen.');
    //         }

    //         // Crear registro en base de datos
    //         QrCode::create([
    //             'content' => $content,
    //             'type' => $request->type,
    //             'description' => $request->description,
    //             'scanned_at' => now(),
    //         ]);

    //         // Eliminar archivo temporal
    //         Storage::delete('temp/qr-temp.png');

    //         return redirect()->route('qrcodes.index')
    //             ->with('success', 'Código QR leído y almacenado correctamente.');
                
    //     } catch (\Exception $e) {
    //         // Eliminar archivo temporal en caso de error
    //         Storage::delete('temp/qr-temp.png');
            
    //         return back()->with('error', 'Error al procesar el código QR: ' . $e->getMessage());
    //     }
    // }

    // Este método es sólo para el ejemplo, en un caso real usarías una biblioteca para leer QR
    private function simulateQrReading($imagePath)
    {
        // Esta es una simulación, en un proyecto real usarías una biblioteca como:
        // https://github.com/khanamiryan/php-qrcode-detector-decoder
        // composer require khanamiryan/qrcode-detector-decoder
        
        // Ejemplo de cómo sería con la biblioteca khanamiryan:
        /*
        $qrcode = new \QrReader($imagePath);
        $text = $qrcode->text();
        return $text;
        */
        
        // Para este ejemplo, devolvemos un valor simulado
        return "https://ejemplo.com/producto/123456";
    }
}
