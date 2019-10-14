<?php 

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance for the given datetime and/or timezone.
     *
     * @param  \DateTime|string|null $datetime
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     */
    function carbon($datetime = null, $tz = null)
    {
        if ($datetime instanceof \DateTime) {
            return \Illuminate\Support\Carbon::instance($datetime)->setTimezone($tz);
        }
        
        return \Illuminate\Support\Carbon::parse($datetime, $tz);
    }
}

if (! function_exists('rp')) {

	/**
	 * Untuk menjadikan angka ke rupiah format
	 *
	 * @param string $rupiah
	 * @return string
	 */
	function rp($rupiah) : ?string
	{

		$rupiah = "Rp " . number_format($rupiah , 2 , "," , "."); 

   		return str_replace(",00", ",-", $rupiah);

	}
}

if (! function_exists('admin')) {
    /**
     * Determine if user administrator or just a user
     *
     * @return bool|null
     */
    function admin()
    {
        if (auth()->check()) {
        	
        	if(auth()->user()->hasRole('administrator')){
        		return true;
        	}
        }

        return null;
    }
}

if (! function_exists('customer')) {
    /**
     * Determine if user administrator or just a user
     *
     * @return bool|null
     */
    function customer()
    {
        if (auth()->check()) {
        	
        	if(auth()->user()->hasRole('user')){
        		return true;
        	}
        }

        return null;
    }
}

if (! function_exists('subscriber')) {
    /**
     * Determine if user administrator or a subscriber
     *
     * @return bool|null
     */
    function subscriber()
    {
        if (auth()->check()) {
        	
        	if(auth()->user()->hasRole('subscriber')){
        		return true;
        	}
        }

        return null;
    }
}

if (! function_exists('trial')) {
    /**
     * Determine if user administrator or a trial
     *
     * @return bool|null
     */
    function trial()
    {
        if (auth()->check()) {
        	
        	if(auth()->user()->hasRole('trial')){
        		return true;
        	}
        }

        return null;
    }
}

if (! function_exists('unsubscriber')) {
    /**
     * Determine if user administrator or a unsubscriber
     *
     * @return bool|null
     */
    function unsubscriber()
    {
        if (auth()->check()) {
        	
        	if(auth()->user()->hasRole('unsubscriber')){
        		return true;
        	}
        }

        return null;
    }
}

if (! function_exists('bulan')) {

	/**
	 * Merubah angka bulan menjadi string (Indonesia)
	 *
	 * @param string $bulan
	 * @return string
	 */
	function bulan($bulan) : ?string
	{
	    switch ($bulan) {

	        case 1:$bulan = "Januari";

	            break;

	        case 2:$bulan = "Februari";

	            break;

	        case 3:$bulan = "Maret";

	            break;

	        case 4:$bulan = "April";

	            break;

	        case 5:$bulan = "Mei";

	            break;

	        case 6:$bulan = "Juni";

	            break;

	        case 7:$bulan = "Juli";

	            break;

	        case 8:$bulan = "Agustus";

	            break;

	        case 9:$bulan = "September";

	            break;

	        case 10:$bulan = "Oktober";

	            break;

	        case 11:$bulan = "November";

	            break;

	        case 12:$bulan = "Desember";

	            break;

	    }

	    return $bulan;
	}

}

if (! function_exists('bulan_tahun')) {
	
	/**
	 * Merubah date format (Y-m-d) menjadi ex : Januari 2000
	 * tanpa hari
	 *
	 * @param string $tanggal
	 * @return string
	 */
	function bulan_tahun(string $tanggal) : ?string
	{
	    $bulan = [

            1 => 'Januari',

            'Februari',

            'Maret',

            'April',

            'Mei',

            'Juni',

            'Juli',

            'Agustus',

            'September',

            'Oktober',

            'November',

            'Desember',

        ];

        $ex = explode('-', $tanggal);

        return $bulan[(int) $ex[1]] . ' ' . $ex[0];
	}

}

if (! function_exists('tanggal_indo')) {
	
	/**
	 * Merubah date format menjadi string
	 * Format tahun bulan tanggal
	 *
	 * @param string $tanggal
	 * @return string
	 */
	function tanggal_indo(string $tanggal) : ?string
	{
	    $bulan = [

	        1 => 'Januari',

	        'Februari',

	        'Maret',

	        'April',

	        'Mei',

	        'Juni',

	        'Juli',

	        'Agustus',

	        'September',

	        'Oktober',

	        'November',

	        'Desember',

	    ];

	    $ex = explode('-', $tanggal);

	    return $ex[2] . ' ' . $bulan[(int) $ex[1]] . ' ' . $ex[0];
	}
}

if (! function_exists('reverse_tanggal_indo')) {
	
	/**
	 * Merubah date format menjadi string
	 * Format tanggal bulan tahun
	 *
	 * @param string $tanggal
	 * @return string
	 */
	function reverse_tanggal_indo(string $tanggal) : ?string
	{
	    $bulan = [

	        1 => 'Januari',

	        'Februari',

	        'Maret',

	        'April',

	        'Mei',

	        'Juni',

	        'Juli',

	        'Agustus',

	        'September',

	        'Oktober',

	        'November',

	        'Desember',

	    ];

	    $ex = explode('-', $tanggal);

	    return  $ex[0]. ' ' . $bulan[(int) $ex[1]] . ' ' . $ex[2];
	}
}