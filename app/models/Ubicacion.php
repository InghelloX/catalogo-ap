<?php
/**
 * Modelo de ubicaciones soportadas: Colombia y España.
 * Es la única fuente de datos para el autocompletado (JS) y la validación (PHP).
 */
class Ubicacion
{
    public const PAISES = [
        'Colombia' => [
            'codigo'          => 'CO',
            'documento'       => 'Cédula de ciudadanía',
            'documento_ayuda' => 'Solo números, entre 6 y 10 dígitos.',
            'documento_patron'=> '^[0-9]{6,10}$',
            'region'          => 'Departamento',
        ],
        'España' => [
            'codigo'          => 'ES',
            'documento'       => 'DNI / NIE',
            'documento_ayuda' => 'DNI: 8 números y una letra (12345678Z). NIE: X, Y o Z + 7 números y una letra.',
            'documento_patron'=> '^([0-9]{8}[A-Za-z]|[XYZxyz][0-9]{7}[A-Za-z])$',
            'region'          => 'Comunidad autónoma',
        ],
    ];

    /** Ciudad => región, agrupadas por país. */
    private const CIUDADES = [
        'Colombia' => [
            'Bogotá' => 'Bogotá D.C.', 'Medellín' => 'Antioquia', 'Cali' => 'Valle del Cauca',
            'Barranquilla' => 'Atlántico', 'Cartagena' => 'Bolívar', 'Cúcuta' => 'Norte de Santander',
            'Soacha' => 'Cundinamarca', 'Soledad' => 'Atlántico', 'Bucaramanga' => 'Santander',
            'Bello' => 'Antioquia', 'Villavicencio' => 'Meta', 'Ibagué' => 'Tolima',
            'Santa Marta' => 'Magdalena', 'Valledupar' => 'Cesar', 'Montería' => 'Córdoba',
            'Pereira' => 'Risaralda', 'Manizales' => 'Caldas', 'Pasto' => 'Nariño',
            'Neiva' => 'Huila', 'Palmira' => 'Valle del Cauca', 'Popayán' => 'Cauca',
            'Buenaventura' => 'Valle del Cauca', 'Floridablanca' => 'Santander', 'Armenia' => 'Quindío',
            'Sincelejo' => 'Sucre', 'Itagüí' => 'Antioquia', 'Tumaco' => 'Nariño',
            'Envigado' => 'Antioquia', 'Dosquebradas' => 'Risaralda', 'Tuluá' => 'Valle del Cauca',
            'Barrancabermeja' => 'Santander', 'Riohacha' => 'La Guajira', 'Girón' => 'Santander',
            'Maicao' => 'La Guajira', 'Piedecuesta' => 'Santander', 'Tunja' => 'Boyacá',
            'Florencia' => 'Caquetá', 'Quibdó' => 'Chocó', 'Yopal' => 'Casanare',
            'Jamundí' => 'Valle del Cauca', 'Yumbo' => 'Valle del Cauca', 'Cartago' => 'Valle del Cauca',
            'Buga' => 'Valle del Cauca', 'Facatativá' => 'Cundinamarca', 'Zipaquirá' => 'Cundinamarca',
            'Chía' => 'Cundinamarca', 'Fusagasugá' => 'Cundinamarca', 'Girardot' => 'Cundinamarca',
            'Mosquera' => 'Cundinamarca', 'Funza' => 'Cundinamarca', 'Rionegro' => 'Antioquia',
            'Sabaneta' => 'Antioquia', 'Apartadó' => 'Antioquia', 'Turbo' => 'Antioquia',
            'Sogamoso' => 'Boyacá', 'Duitama' => 'Boyacá', 'Ipiales' => 'Nariño',
            'Magangué' => 'Bolívar', 'Ocaña' => 'Norte de Santander', 'Malambo' => 'Atlántico',
            'Arauca' => 'Arauca', 'Mocoa' => 'Putumayo', 'San Andrés' => 'San Andrés y Providencia',
            'Leticia' => 'Amazonas', 'San José del Guaviare' => 'Guaviare', 'Inírida' => 'Guainía',
            'Mitú' => 'Vaupés', 'Puerto Carreño' => 'Vichada',
        ],
        'España' => [
            'Madrid' => 'Comunidad de Madrid', 'Barcelona' => 'Cataluña', 'Valencia' => 'Comunidad Valenciana',
            'Sevilla' => 'Andalucía', 'Zaragoza' => 'Aragón', 'Málaga' => 'Andalucía',
            'Murcia' => 'Región de Murcia', 'Palma' => 'Islas Baleares', 'Las Palmas de Gran Canaria' => 'Canarias',
            'Bilbao' => 'País Vasco', 'Alicante' => 'Comunidad Valenciana', 'Córdoba' => 'Andalucía',
            'Valladolid' => 'Castilla y León', 'Vigo' => 'Galicia', 'Gijón' => 'Asturias',
            "L'Hospitalet de Llobregat" => 'Cataluña', 'Vitoria-Gasteiz' => 'País Vasco', 'A Coruña' => 'Galicia',
            'Elche' => 'Comunidad Valenciana', 'Granada' => 'Andalucía', 'Terrassa' => 'Cataluña',
            'Badalona' => 'Cataluña', 'Sabadell' => 'Cataluña', 'Oviedo' => 'Asturias',
            'Cartagena' => 'Región de Murcia', 'Móstoles' => 'Comunidad de Madrid', 'Jerez de la Frontera' => 'Andalucía',
            'Pamplona' => 'Navarra', 'Almería' => 'Andalucía', 'Alcalá de Henares' => 'Comunidad de Madrid',
            'Fuenlabrada' => 'Comunidad de Madrid', 'Leganés' => 'Comunidad de Madrid', 'Getafe' => 'Comunidad de Madrid',
            'Alcorcón' => 'Comunidad de Madrid', 'Torrejón de Ardoz' => 'Comunidad de Madrid', 'San Sebastián' => 'País Vasco',
            'Santander' => 'Cantabria', 'Burgos' => 'Castilla y León', 'Castellón de la Plana' => 'Comunidad Valenciana',
            'Albacete' => 'Castilla-La Mancha', 'Santa Cruz de Tenerife' => 'Canarias', 'Logroño' => 'La Rioja',
            'Badajoz' => 'Extremadura', 'Salamanca' => 'Castilla y León', 'Huelva' => 'Andalucía',
            'Marbella' => 'Andalucía', 'Lleida' => 'Cataluña', 'Tarragona' => 'Cataluña',
            'León' => 'Castilla y León', 'Cádiz' => 'Andalucía', 'Jaén' => 'Andalucía',
            'Ourense' => 'Galicia', 'Lugo' => 'Galicia', 'Pontevedra' => 'Galicia',
            'Santiago de Compostela' => 'Galicia', 'Girona' => 'Cataluña', 'Cáceres' => 'Extremadura',
            'Mérida' => 'Extremadura', 'Toledo' => 'Castilla-La Mancha', 'Ciudad Real' => 'Castilla-La Mancha',
            'Guadalajara' => 'Castilla-La Mancha', 'Cuenca' => 'Castilla-La Mancha', 'Segovia' => 'Castilla y León',
            'Ávila' => 'Castilla y León', 'Zamora' => 'Castilla y León', 'Palencia' => 'Castilla y León',
            'Soria' => 'Castilla y León', 'Huesca' => 'Aragón', 'Teruel' => 'Aragón',
            'Benidorm' => 'Comunidad Valenciana', 'Ibiza' => 'Islas Baleares', 'Ceuta' => 'Ceuta',
            'Melilla' => 'Melilla',
        ],
    ];

    public static function paises(): array
    {
        return array_keys(self::PAISES);
    }

    public static function esPaisValido(string $pais): bool
    {
        return isset(self::PAISES[$pais]);
    }

    /** Lista plana: [['ciudad'=>..., 'region'=>..., 'pais'=>...], ...] */
    public static function ciudades(): array
    {
        $lista = [];
        foreach (self::CIUDADES as $pais => $ciudades) {
            foreach ($ciudades as $ciudad => $region) {
                $lista[] = ['ciudad' => $ciudad, 'region' => $region, 'pais' => $pais];
            }
        }
        usort($lista, fn($a, $b) => strcmp(self::normalizar($a['ciudad']), self::normalizar($b['ciudad'])));
        return $lista;
    }

    /**
     * Devuelve todas las coincidencias exactas (sin tildes ni mayúsculas) de una ciudad.
     * Puede haber más de una: "Cartagena" existe en Colombia y en España.
     */
    public static function buscar(string $ciudad): array
    {
        $clave = self::normalizar($ciudad);
        return array_values(array_filter(
            self::ciudades(),
            fn($c) => self::normalizar($c['ciudad']) === $clave
        ));
    }

    /** "  BOGOTÁ " => "bogota" */
    public static function normalizar(string $texto): string
    {
        $texto = mb_strtolower(trim($texto), 'UTF-8');
        $texto = strtr($texto, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'ü' => 'u', 'à' => 'a', 'è' => 'e', 'ò' => 'o', 'ï' => 'i', 'ç' => 'c',
        ]);
        return preg_replace('/\s+/', ' ', $texto);
    }
}
