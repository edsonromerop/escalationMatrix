class AppController {

    constructor (element, animation, speed, a, b, c, d, e) {
        this.element = element;
        this.animation = animation;
        this.spedd = speed;
        this.a = a;
        this.b = b;
        this.c = c;
        this.d = d;
        this.e = e;
    }

    testFunction() {
        alert('Test function ok');
    }

    sessionController(a, b) {
        let c = window.location.pathname;
        let d = c.split('/');
        if(d[2] != a && d[2] != b) {
            let IDLE_TIMEOUT = 900; //seconds
            let _idleSecondsCounter = 0;
    
            document.onclick = function() {
                _idleSecondsCounter = 0;
            };
    
            document.onmousemove = function() {
                _idleSecondsCounter = 0;
            };
    
            document.onkeypress = function() {
                _idleSecondsCounter = 0;
            };
    
            window.setInterval(CheckIdleTime, 1000);
    
                function CheckIdleTime() {   
                _idleSecondsCounter++;
                let oPanel = document.getElementById("SecondsUntilExpire");
                if (oPanel)
                // oPanel.innerHTML = "La sesión termina en " + (IDLE_TIMEOUT - _idleSecondsCounter) + "";
                if (_idleSecondsCounter >= IDLE_TIMEOUT) {
                    alert("La sesión ha terminado por inactividad!");
                    window.location = "logout";                
                }
            }
        }
    }

    animate(element, animation, speed) {
        if(element) {
            for(var i = 0; i < element.length; i++) {
                element[i].classList.add('animated', animation, speed);
            }
        }
    }

    collapse(a, b, c) {
        if (a || b || c) {
            a.addEventListener('click', () => {
                b.classList.toggle('collapseBar');
                c.classList.toggle('collapseBar__main');
            });
        }
    }

    rangeController(a, b) {
        if (a || b) {
            b.value = secondsToHms(a.value);
            a.oninput = function() {
                let time = secondsToHms(this.value);
                b.value = time;
            }
        }
    }

    activeLinks(element, animation) {
        for(let i = 0; i < element.length; i++) {
            if (element[i].href == window.location.href) {
                element[i].classList.add('active', 'animated', animation);
            } else {
                element[i].classList.remove('active');
            }
        }
                
    }

    particles(element, a, b) {
        if(element) {
            /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
            particlesJS.load(a, b);
        }
        
    }

    getPassData(a, b, c, d) {

        if(b == '') {
            d = new FormData(c);
            d.append('validarData', 'ok');
        } else {
            d = new FormData();
            d.append(b, b);
        }


        fetch(a, {
            method: 'POST', // or 'PUT'
            body: d, // data can be `string` or {object}!
        })
        .then(res => res.json())
        .then(data => {
            //Do something with the answer
            if(
            //    data.fechaExp == d.get('fechaNac') &&
               data.documento == d.get('documento') &&
               data.vhur == d.get('vhur')
               ) {
                document.querySelector('#password').removeAttribute('disabled');
                document.querySelector('#confirmPassword').removeAttribute('disabled');
            } else {
                document.querySelector('#password').setAttribute('disabled', 'disabled');
                document.querySelector('#confirmPassword').setAttribute('disabled', 'disabled');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    fetchAction(a, b, c, d, e) {

        if(b == '') {
            e = new FormData(c);
            e.append(d, d);
        } else {
            e = new FormData();
            e.append(b, b);
        }


        fetch(a, {
            method: 'POST',
            body: e
        })
        .then(res => res.json())
        .then(data => {
            // Do something with the answer
            if(data) {
                let timerInterval;
                Swal.fire({
                    title: "Exito!:",
                    text: data.mensaje,
                    type: "success",
                    timer: 3500,
                    toast: true,
                    position: "center",
                    showConfirmButton: false
                })
                setTimeout(function(){
                    window.location.reload(); 
                },3500)
                
            } else {
                let timerInterval;
                Swal.fire({
                    title: "Error!:",
                    text: "No se ha enviado la información, intenta nuevamente.",
                    type: "error",
                    timer: 5000,
                    toast: true,
                    position: "center",
                    showConfirmButton: false
                })
            }
            
            
        })
        .catch(error => console.error('Error:', error));

        
        

    }

    // This method allows to removetoggle Itemes like clases or attributes on an object array
    toggleItems(a, b, c, d, e) {
        e.addEventListener('click', () => {
            if (a === 'attribute' && b === 'toggle') {
                for(let i = 0; i < c.length; i++) {
                        c[i].toggleAttribute(d);
                } 
            } else if(a === 'classList' && b === 'toggle') {
                for(let i = 0; i < c.length; i++) {
                    c[i].classList.toggle(d);
                } 
            }
        })
    }
    
    daysBetween(a, b, c, d) {
        a = new Date(a.substring(0, 4) + '/' + a.substring(5, 7) + '/' + a.substring(8, 10));
        b = new Date(b.substring(0, 4) + '/' + b.substring(5, 7) + '/' + b.substring(8, 10));
        c = Math.abs(b.getTime()) - Math.abs(a.getTime());
        d = Math.ceil(c / (1000 * 3600 * 24)) + 1;
        return d;
        // const _MS_PER_DAY = 1000 * 86400;
        // const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
        // const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());
        // return Math.floor((utc2 - utc1) / _MS_PER_DAY);
    }

}

class GlobalFunctions {

    init_DataTables (a) {
        // Jquery Plugins Functions Init
        $(a,).DataTable({
            // fixedHeader: true,
            // dom: 'Bfrtip',
            dom: 'Bf',
            buttons: [
                'csv',
                'pdf',
            ],
            paging: false,
            language: {
                processing:     "Procesando...",
                search:         "Filtrar por:",
                lengthMenu:    "Mostrando _MENU_ elementos",
                info:           "Mostrando _START_ al _END_ de _TOTAL_ registros",
                infoEmpty:      "No hay registros para mostrar",
                infoFiltered:   "(Filtrado de _MAX_ registros en total)",
                infoPostFix:    "",
                loadingRecords: "Cargando registros...",
                zeroRecords:    "No hay registros para mostrar",
                emptyTable:     "No hay información para esta tabla",
                paginate: {
                    first:      "Primero",
                    previous:   "Anterior",
                    next:       "Siguiente",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": Ordenar de forma ascendente",
                    sortDescending: ": Ordenar de forma descendente"
                }
            }
        });
        this.inputs(document.getElementsByTagName('input'));
    }

    destroy_DataTables (a) {
        const table = $(a).DataTable();
        table.destroy();
    }

    inputs(elm) {
        for(let a of elm){
            a.classList.add('form-control');
        }
    }
}



window.addEventListener('load', () => {
    try {
        //Init Functions
        feather.replace();



        // DOM Elements
        const domElements = {

            //App Elements
            boolean             :   false,
            cards               :   document.querySelectorAll('.card'),
            inputs              :   document.getElementsByTagName('input'),
            selects             :   document.getElementsByTagName('select'),
            buttons             :   document.getElementsByTagName('button'),
            particlesContent    :   document.querySelector('#particlesContent-js'),

            // Login Elements
            inputUsuario        :   document.querySelector('#inputUsuario'),
            particlesLogin      :   document.querySelector('#particles-js'),
            formPassword        :   document.querySelector('#rec__password'),
            form_signin         :   document.querySelector('.form-signin'),
            recPass             :   document.getElementById('password'),
            recConfirmPass      :   document.getElementById('confirmPassword'),
            btnResetPass        :   document.getElementById('reset__password'),
            btnLogin            :   document.querySelector('#btnLogin'),
            alertPass           :   document.querySelector('#pass__alert'),
            passStrong           :   document.querySelector('#pass__strong'),
            vhur                :   document.querySelector('#vhur'),

            // Menu Elements
            btnCollapse         :   document.querySelector('#collapse'),
            sidebar             :   document.querySelector('.sidebar'),
            main                :   document.querySelector('.main'),
            links               :   document.querySelectorAll('.nav-link'),
            cerrarSesion        :   document.querySelector('#cerrarSesion'),
            userData            :   document.querySelector('.little-profile2'),
            navbar              :   document.querySelectorAll('.navbar'),

            //Novedades Pendientes Elements
            slider              :   document.querySelector('#input__time'),
            output              :   document.querySelector('#input__timeResult'),
            btnNov              :   document.querySelectorAll('.btnNov'),
            fecNovedad          :   document.querySelector('#fecNovedad'),
            fecInicio           :   document.querySelector('#fecInicio'),
            fecFin              :   document.querySelector('#fecFin'),
            incNovedad          :   document.querySelector('#incNovedad'),
            documento           :   document.querySelector('#documento'),
            tipNovedad          :   document.querySelector('#tip__novedad'),
            fecINovedad         :   document.querySelector('#fecINovedad'),
            fecFNovedad         :   document.querySelector('#fecFNovedad'),
            diasNovedad         :   document.querySelector('#diasNovedad'),
            diasNov             :   document.querySelector('#diasNov'),
            horasNovedad        :   document.querySelector('#horasNovedad'),   
            horasNovedadSlider  :   document.querySelector('#horasNovedadSlider'),
            contHoras           :   document.querySelectorAll('.contHoras'),
            contDias            :   document.querySelectorAll('.contDias'),
            formNovedad         :   document.querySelector('#rep__novedad'),
            obsNovedad          :   document.querySelector('#obsNovedad'),
            btn__novedad        :   document.querySelector('#btn__novedad'),
            btn__novUga         :   document.querySelector('#btn__novUga'),
            tbl__container      :   document.querySelector('.tbl__container'),
            tbl__container      :   document.querySelector('.tbl__container'),
            grafNovedades       :   document.getElementById("grafNovedades"),
        }


        //Controller Functions
        const controller = new AppController();
        // controller.animate(domElements.cards, 'flipInX');
            controller.animate(domElements.inputs, 'fadeIn');
            controller.animate(domElements.selects, 'fadeIn');
            controller.animate(domElements.buttons, 'fadeIn','slow');
            controller.animate(domElements.main, 'bounceInUp','slow');
            controller.collapse(domElements.btnCollapse, domElements.sidebar, domElements.main, domElements.userData);
            controller.rangeController(domElements.slider, domElements.output);
            controller.activeLinks(domElements.links, 'pulse');
            controller.particles(domElements.particlesLogin, 'particles-js', 'particles.json');
            controller.particles(domElements.particlesContent, 'particlesContent-js', 'particlesBlack.json');
            controller.sessionController('login', 'logout');
        



        //User Interface Functions


        if(domElements.vhur) {

            let strong = false;
            let equal = false;

            domElements.vhur.addEventListener('keyup', () => {
                controller.getPassData('fetch/user.fetch.php', '', domElements.formPassword);
            })

            domElements.recConfirmPass.addEventListener('keyup', () => {
                
                if(/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*+-.;])[\w!@#$%^&*+-.;]{8,}$/.test(domElements.recPass.value)) {
                    domElements.passStrong.innerHTML = '';
                    domElements.passStrong.innerHTML = `<div class="text-success mt-2">
                                                            <i data-feather="thumbs-up"></i> ¡Password seguro! 
                                                        </div>`;
                    strong = true;
                } else {
                    domElements.passStrong.innerHTML = '';
                    domElements.passStrong.innerHTML = `<div class="text-danger mt-2">
                                                            <i data-feather="thumbs-down"></i> ¡Password inseguro! 
                                                        </div>`;
                    strong = false;
                }
                if(domElements.recConfirmPass.value != domElements.recPass.value) {
                    domElements.alertPass.innerHTML = '';
                    domElements.alertPass.innerHTML = `<div class="text-danger mt-2">
                                                            <i data-feather="thumbs-down"></i> ¡Los campos no coinciden! 
                                                    </div>`;
                    equal = false;
                } else {
                    
                    domElements.alertPass.innerHTML = '';
                    domElements.alertPass.innerHTML = `<div class="text-success mt-2">
                                                            <i data-feather="thumbs-up"></i> ¡Password validado! 
                                                      </div>`;
                    equal = true;
                }
                
                feather.replace();
            })
            
            domElements.btnResetPass.addEventListener('click', () => {
                if(strong && equal) {
                    controller.fetchAction('fetch/user.fetch.php', '', domElements.formPassword, 'cambiarPass');
                } else {
                    Swal.fire({
                        title: "Error!:",
                        text: "El password es inseguro o los campos no coinciden verifica nuevamente.",
                        type: "error",
                        timer: 4000,
                        toast: true,
                        position: "center",
                        showConfirmButton: false
                    })
                }
            })

        }


        if(domElements.recConfirmPass) {
            
        }

        if(domElements.btnNov) {
            for(let i = 0; i < domElements.btnNov.length; i++) {
                domElements.btnNov[i].addEventListener('click', () => {
                    let d = new FormData(document.querySelector('#form' + i))
                    domElements.slider.setAttribute('max', d.get('horasNovedad'));
                    domElements.fecNovedad.value = d.get('fecNovedad');
                    domElements.incNovedad.value = d.get('increyble');
                    domElements.documento.value = d.get('documento');
                    domElements.fecINovedad.value = d.get('fecNovedad');
                    domElements.fecFNovedad.value = d.get('fecNovedad');
                    domElements.fecFNovedad.setAttribute('min', d.get('fecNovedad'));
                    domElements.obsNovedad.value = '';
                    domElements.diasNov.value = controller.daysBetween(domElements.fecINovedad.value, domElements.fecFNovedad.value);

                }) 
            }
    
                        
        }

        if(domElements.tipNovedad) {
            domElements.tipNovedad.addEventListener('change', () => {
                if(domElements.tipNovedad.value === 'Dias') {
                    controller.toggleItems('attribute', 'toggle', domElements.contDias, 'hidden')
                    controller.toggleItems('attribute', 'toggle', domElements.contHoras, 'hidden')
                } else if(domElements.tipNovedad.value === 'Horas') {
                    controller.toggleItems('attribute', 'toggle', domElements.contHoras, 'hidden')
                    controller.toggleItems('attribute', 'toggle', domElements.contDias, 'hidden')
                }
            })
        }

        if(domElements.fecInicio) {
            domElements.fecFin.addEventListener('change', () => {
                    domElements.diasNov.value = controller.daysBetween(domElements.fecINovedad.value, domElements.fecFNovedad.value);
            });

            domElements.btn__novedad.addEventListener('click', () => {
                let d = new FormData(domElements.formNovedad);
                for(let [key, value] of d) {
                    console.log(key, value, value.length);
                    if(value.length <= 0) {
                        domElements.boolean = false;
                        Swal.fire({
                            title: "Error!:",
                            text: "Unos de los campos está vacío, por favor completalo para continuar.",
                            type: "error",
                            showCloseButton: true,
                            timer: 5000,
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false
                        })
                        break;
                    } else {
                        domElements.boolean = true;
                    }   
                    console.log(domElements.boolean);
                }

                if(domElements.boolean) {
                    Swal.fire({
                        title: "¿Reportar Novedad?:",
                        text: "Asegurate que la información sea correcta..",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Continuar',
                        cancelButtonText: 'Volver',
                        showCloseButton: true,
                        toast: true,
                        position: "center",
                    }).then((result) => {
                       if (result.value) {
                            controller.fetchAction('fetch/novedad.fetch.php', '', domElements.formNovedad, 'escalado')
                        }
                      });                    
                } 

            })
            
        }

        if(domElements.btn__novUga) {
            domElements.btn__novUga.addEventListener('click', () => {
                domElements.tbl__container.removeAttribute('hidden');
            })
        }


        if(domElements.cerrarSesion) {
            domElements.cerrarSesion.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'Cerrar sesión',
                    text: "Estas seguro?",
                    type: 'info',
                    toast: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cerrar sesión',
                    cancelButtonText: 'Cancelar',
                    })
                .then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Sesión terminada',
                            type: 'success',
                            toast: true,
                            showConfirmButton: false,
                        })
                        setTimeout(function(){
                            window.location = 'logout'; 
                        },1500)
                    }
                })
            })
        }
        

        if(domElements.navbar) {
            controller.toggleItems('classList', 'toggle', domElements.navbar, 'navCollapse', domElements.btnCollapse);
        }



    } catch (e) {
        console.log();
    }

});


function secondsToHms(d) {
    d = Number(d);
    let h = Math.floor(d / 3600);
    let m = Math.floor(d % 3600 / 60);
    let s = Math.floor(d % 3600 % 60);

    if(h >= 0 && h < 10) {
        h = '0' + h;
    } else {
        h = h;
    }
    
    if(m >= 0 && m < 10) {
        m = '0' + m;
    } else {
        h = h;
    }
    if(s >= 0 && s < 10) {
        s = '0' + s;
    } else {
        s = s;
    }
    return h + ':' + m + ':' + s; 
}

