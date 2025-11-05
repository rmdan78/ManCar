<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// Pastikan ini adalah lokasi model Tenant Anda
use App\Models\Tenant; 
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];

        $defaultConnection = DB::getDefaultConnection();

        $tenant = Tenant::on($defaultConnection)->where('subdomain', $subdomain)->first();

        if (! $tenant) {
            abort(404, "Perusahaan tidak ditemukan.");
        }

        Config::set('database.connections.' . $defaultConnection . '.host', $tenant->db_host);
        Config::set('database.connections.' . $defaultConnection . '.database', $tenant->db_name);
        Config::set('database.connections.' . $defaultConnection . '.username', $tenant->db_username);
        Config::set('database.connections.' . $defaultConnection . '.password', $tenant->db_password);

        DB::purge($defaultConnection);
        DB::reconnect($defaultConnection);
        
        Config::set('database.default', $defaultConnection);

        app()->instance('tenant', $tenant);

        return $next($request);
    }
}
