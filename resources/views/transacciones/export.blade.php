    <h1 style="background: #ffb3a4">ANTES DE INPORTAR POR FAVOR ELIMINAR LA FILA 1 Y 3 POR FAVOR</h1>
    <h3>PARA DIGITAR EL PUC SE RECOMIENDA TENER LA PLANTILLA DE TODO EL PUC DE SU SISTEMA Y SOLO AGREGAR EL CAMPO ID</h3>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>DOCUEMENTO</th>
        <th>DOCUMENTO DE REFERENCIA</th>
        <th>ID PUC</th>
        <th>DEBITO</th>
        <th>CREDITO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trans as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->numeroDoc }}</td>
        </tr>
    @endforeach
    </tbody>
</table>