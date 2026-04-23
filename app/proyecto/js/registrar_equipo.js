function obtenerEquipos() {
    const equipos = localStorage.getItem('equipos');
    return equipos ? JSON.parse(equipos) : [];
}
 
function guardarEquipos(equipos) {
    localStorage.setItem('equipos', JSON.stringify(equipos));
}
 
function codigoExiste(codigo) {
    const equipos = obtenerEquipos();
    return equipos.some(e => e.codigo.toLowerCase() === codigo.toLowerCase());
}
 
const reglas = {
    codigo: {
        label: 'Código del equipo',
        validar(val) {
            if (!val) return 'El código del equipo es obligatorio.';
            if (!/^[a-zA-Z0-9\-_]+$/.test(val)) return 'Solo letras, números, guiones y guiones bajos.';
            if (codigoExiste(val)) return `Ya existe un equipo con el código "${val}".`;
            return null;
        }
    },
    tipo: {
        label: 'Tipo de equipo',
        validar(val) {
            if (!val) return 'Debe seleccionar un tipo de equipo.';
            return null;
        }
    },
    marca: {
        label: 'Marca',
        validar(val) {
            if (!val) return 'La marca es obligatoria.';
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\.]+$/.test(val)) return 'Solo puede contener letras, espacios y guiones.';
            return null;
        }
    },
    modelo: {
        label: 'Modelo',
        validar(val) {
            if (!val) return 'El modelo es obligatorio.';
            return null;
        }
    },
    serie: {
        label: 'Número de serie',
        validar(val) {
            if (!val) return 'El número de serie es obligatorio.';
            if (!/^[a-zA-Z0-9\-]+$/.test(val)) return 'Solo letras, números y guiones.';
            return null;
        }
    },
    estado: {
        label: 'Estado',
        validar(val) {
            if (!val) return 'Debe seleccionar un estado.';
            return null;
        }
    }
};
 
function obtenerErrores(soloTocados = false) {
    const errores = [];
    for (const [id, regla] of Object.entries(reglas)) {
        const campo = document.getElementById(id);
        if (!campo) continue;
        if (soloTocados && !campo.dataset.tocado) continue;
        const error = regla.validar(campo.value.trim());
        if (error) errores.push({ id, label: regla.label, mensaje: error });
    }
    return errores;
}
 
function actualizarErrorBox() {
    const box = document.getElementById('errorBox');
    if (!box) return;
 
    const erroresPendientes = obtenerErrores(false);
 
    if (erroresPendientes.length === 0) {
        box.style.display = 'none';
        return;
    }
 
    box.style.display = 'block';
 
    const lista = erroresPendientes.map(e => {
        const tocado = document.getElementById(e.id)?.dataset.tocado;
        const color = tocado ? 'var(--color-text-danger)' : 'var(--color-text-secondary)';
        const icono = tocado ? '⚠' : '○';
        const texto = tocado ? e.mensaje : e.label;
        return `<li style="padding:3px 0;font-size:13px;color:${color};display:flex;gap:6px;align-items:flex-start;">
                    <span style="flex-shrink:0;font-size:12px;margin-top:1px;">${icono}</span>
                    <span>${texto}</span>
                </li>`;
    }).join('');
 
    box.innerHTML = `
        <div style="
            border:0.5px solid var(--color-border-danger);
            border-radius:var(--border-radius-md);
            background:var(--color-background-danger);
            padding:12px 16px;
            margin-top:20px;
        ">
            <p style="font-size:13px;font-weight:500;color:var(--color-text-danger);margin:0 0 8px 0;">
                Faltan completar los siguientes campos:
            </p>
            <ul style="margin:0;padding-left:0;list-style:none;">${lista}</ul>
        </div>`;
}
 
function registrarEventosCampos() {
    for (const id of Object.keys(reglas)) {
        const campo = document.getElementById(id);
        if (!campo) continue;
        const marcarYActualizar = () => {
            campo.dataset.tocado = '1';
            actualizarErrorBox();
        };
        campo.addEventListener('blur', marcarYActualizar);
        campo.addEventListener('change', marcarYActualizar);
        campo.addEventListener('input', () => {
            if (campo.dataset.tocado) actualizarErrorBox();
        });
    }
}
 
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (!form) return;
 
    const errorBox = document.createElement('div');
    errorBox.id = 'errorBox';
    errorBox.style.display = 'none';
    form.appendChild(errorBox);
 
    registrarEventosCampos();
    actualizarErrorBox();
 
    form.addEventListener('submit', function (e) {
        e.preventDefault();
 
        for (const id of Object.keys(reglas)) {
            const campo = document.getElementById(id);
            if (campo) campo.dataset.tocado = '1';
        }
        actualizarErrorBox();
 
        if (obtenerErrores(false).length > 0) return;
 
        const datos = {
            codigo: document.getElementById('codigo').value.trim(),
            tipo:   document.getElementById('tipo').value.trim(),
            marca:  document.getElementById('marca').value.trim(),
            modelo: document.getElementById('modelo').value.trim(),
            serie:  document.getElementById('serie').value.trim(),
            estado: document.getElementById('estado').value.trim(),
        };
 
        const equipos = obtenerEquipos();
        equipos.push(datos);
        guardarEquipos(equipos);
        window.location.href = 'equipos.html?registrado=1';
    });
});