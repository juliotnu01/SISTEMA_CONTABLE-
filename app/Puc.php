<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Puc extends Model
{
    protected $fillable=['codigoCuenta', 'codigoSuperior', 'nombreCuenta', 'tipoCuenta_id',
        'naturalezaCuenta', 'CuentaCoNC', 'cuentaCobrar', 'cuentaPagar','cuentaMaestraSalud',
        'refiereFlujo', 'exigeTerceros', 'exigeCentroCostos','exigeBase', 'activa','anio',
        'formatoDian_id', 'conceptoDian_id','opcionesPrivilegios_id','numeroCuenta', 'descripcion',
        'tipoCuentaBancaria', 'situacionFondos', 'usocuentaBancaria', 'posicionClasificadorPresupuestalGastos',
        'posicionClasificadorPresupuestalIngresos', 'codigoInterno', 'codigoSucursal', 'fuentefinanciacionSIA_id',
        'codigoEntidadFinancieraSIA_id', 'cuentaMaestra_id','nivel','porcentaje', 'futExcedentesLiquidez_id','persona_id'];

    public function cuentas()
    {
        return $this->hasMany(Puc::class,'codigoSuperior','codigoCuenta');
    }

    public function formato()
    {
        return $this->belongsTo(formatoDianExogeno::class);
    }

    public function tipoCuentas()
    {
        return $this->belongsTo(TipoCuenta::class);
    }

    public function concepto()
    {
        return $this->belongsTo(conceptoDianExogeno::class);
    }

    public function pucPrivilegio()
    {
        return $this->belongsTo(PrivilegiosPUC::class);
    }

    public function funtesSIA(){
        return $this->belongsTo(FuentesFinancierasSIA::class);
    }

    public function codigoSIA(){
        return $this->belongsTo(CodigoEntidadFinancierasSIA::class);
    }

    public function cuentaMaesta(){
        return $this->belongsTo(CuentaMaesta::class);
    }

    public function furExcedente(){
        return $this->belongsTo(FUTExcedentesLiquidez::class);
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function persona(){
        return $this->belongsTo(PersonasJuridicas::class);
    }

    public function sede()
    {
        return $this->hasMany(Sede::class);
    }

    public function subSede()
    {
        return $this->hasMany(SubSede::class);
    }

    public function niff()
    {
        return $this->hasMany(Niff::class);
    }

    public function retencion()
    {
        return $this->hasMany(Retenciones::class);
    }

    public function descuentos()
    {
        return $this->hasMany(RetencionesDescuentos::class);
    }

    public function plantillaContable()
    {
        return $this->hasMany(PlantillaContable::class);
    }

    public function cierre() :HasMany
    {
        return $this->hasMany(Cierres::class);
    }
}