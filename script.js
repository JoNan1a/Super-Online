document.addEventListener("DOMContentLoaded", function () {
    const carritoLink = document.getElementById("carrito-link");
    const carritoPopup = document.getElementById("carrito-popup");
    const carritoContenido = document.getElementById("carrito-contenido");

    const carritoProductos = [];
    cargarCarritoDesdeAlmacenamiento();

    // Función para cargar productos
    function cargarProductos() {
        const categorias = [
            "Bebidas",
            "Carnes",
            "Frutas",
            "Golosinas",
            "Panaderia",
            "Pastas",
            "Limpieza",
            "Lacteos",
        ];

        categorias.forEach((categoria) => {
            fetch(`assets/json/${categoria}.json`)
                .then((response) => response.json())
                .then((data) => {
                    console.log(`Productos cargados (${categoria}):`, data);

                    if (data[categoria] && Array.isArray(data[categoria])) {
                        const categoriaArticle = document.getElementById(categoria);

                        data[categoria].forEach((producto) => {
                            const card = document.createElement("div");
                            card.classList.add("card");

                            const contenidoCard = `
                                <img src="${producto.img}" alt="${producto.nombre}" class="card-imagen">
                                <div class="card-info">
                                    <h3>${producto.nombre}</h3>
                                    <p>${producto.tipo}</p>
                                    <p>Precio: $${producto.precio.toFixed(
                                    2
                                )}</p>
                                    <button class="agregar-carrito" data-nombre="${producto.nombre}" data-precio="${producto.precio}" data-codigo="${producto.codigo}">Agregar al carrito</button>
                                </div>
                            `;

                            card.innerHTML = contenidoCard;
                            categoriaArticle.appendChild(card);

                            const botonCarrito = card.querySelector(".agregar-carrito");
                            botonCarrito.addEventListener("click", function () {
                                agregarAlCarrito(producto);
                            });
                        });
                    } else {
                        console.error(
                            `Error al cargar los productos (${categoria}): El archivo JSON no tiene la estructura esperada.`
                        );
                    }
                })
                .catch((error) => {
                    console.error(`Error al cargar los productos (${categoria}):`, error);
                });
        });
    }

    // Función para cargar el carrito desde el almacenamiento local
    function cargarCarritoDesdeAlmacenamiento() {
        const carritoGuardado = localStorage.getItem("carrito");
        if (carritoGuardado) {
            const carritoParseado = JSON.parse(carritoGuardado);
            carritoProductos.push(...carritoParseado);
            actualizarCarrito();
        }
    }

    // Función para guardar el carrito en el almacenamiento local
    function guardarCarritoEnAlmacenamiento() {
        localStorage.setItem("carrito", JSON.stringify(carritoProductos));
    }

    // Función para agregar un producto al carrito
    function agregarAlCarrito(producto) {
        const productoEnCarrito = carritoProductos.find(
            (item) => item.codigo === producto.codigo
        );

        if (productoEnCarrito) {
            productoEnCarrito.cantidad += 1;
        } else {
            carritoProductos.push({ ...producto, cantidad: 1 });
        }

        // Guardar el carrito en el almacenamiento local después de agregar un producto
        guardarCarritoEnAlmacenamiento();
        // Mostrar el carrito después de agregar un producto
        actualizarCarrito();
    }

    // Función para eliminar un producto del carrito
    function eliminarProducto(codigo) {
        const productoEnCarrito = carritoProductos.find(
            (item) => item.codigo === codigo
        );

        if (productoEnCarrito) {
            if (productoEnCarrito.cantidad > 1) {
                productoEnCarrito.cantidad -= 1;
            } else {
                // Si la cantidad es 1, eliminar completamente el producto
                const index = carritoProductos.findIndex(
                    (producto) => producto.codigo === codigo
                );
                if (index !== -1) {
                    carritoProductos.splice(index, 1);
                }
            }

            // Guardar el carrito en el almacenamiento local después de eliminar
            guardarCarritoEnAlmacenamiento();
            // Actualizar el contenido del carrito después de eliminar
            actualizarCarrito();
        }
    }

    // Función para aumentar la cantidad de un producto en el carrito
    function aumentarCantidad(codigoProducto) {
        const productoEnCarrito = carritoProductos.find(
            (item) => item.codigo === codigoProducto
        );

        if (productoEnCarrito) {
            productoEnCarrito.cantidad += 1;
        }

        // Guardar el carrito en el almacenamiento local después de aumentar la cantidad
        guardarCarritoEnAlmacenamiento();
        // Actualizar el contenido del carrito después de aumentar la cantidad
        actualizarCarrito();
    }

    // Función para actualizar y mostrar el contenido del carrito
    function actualizarCarrito() {
        // Asegurarse de que el elemento "carrito-contenido" esté presente
        if (!carritoContenido) {
            console.error('No se encontró el elemento con ID "carrito-contenido".');
            return;
        }

        // Limpiar el contenido actual del carrito
        carritoContenido.innerHTML = "";

        // Crear un solo elemento para todos los productos en el carrito
        const elementoCarrito = document.createElement("div");

        // Crear elementos para cada producto en el carrito
        carritoProductos.forEach((producto) => {
            const elementoProducto = document.createElement("div");
            elementoProducto.innerHTML = `
            <p><strong>Nombre:</strong> ${producto.nombre}</p>
            <p><strong>Precio:</strong> $${producto.precio.toFixed(2)}</p>
            <p><strong>Cantidad:</strong> ${producto.cantidad}</p>
            <button class="aumentar-cantidad" data-codigo="${producto.codigo
                }">Aumentar Cantidad</button>
            <button class="eliminar-producto" data-codigo="${producto.codigo
                }">Eliminar</button>
            <hr class="hrItemsCarrito">
        `;

            elementoCarrito.appendChild(elementoProducto);
        });

        // Calcular y mostrar el total
        const total = carritoProductos.reduce(
            (acc, producto) => acc + producto.precio * producto.cantidad,
            0
        );
        elementoCarrito.innerHTML += `<p><strong>Total:</strong> $${total.toFixed(
            2
        )}</p>`;

        // Verificar si hay productos en el carrito
        if (carritoProductos.length > 0) {
            // Agregar el enlace "Finalizar compra" solo si hay productos en el carrito
            const enlaceCompra = document.createElement("a");
            enlaceCompra.href = "compra/formularioCompra.php";
            enlaceCompra.textContent = "Finalizar compra";
            enlaceCompra.classList = "botonFinalizarCompra";
            elementoCarrito.appendChild(enlaceCompra);

            // Agregar evento de clic al enlace "Finalizar compra"
            enlaceCompra.addEventListener("click", function (event) {
                event.preventDefault(); // Evitar que el enlace redireccione inmediatamente

                // Eliminar todos los productos del carrito
                carritoProductos.splice(0, carritoProductos.length);

                // Guardar el carrito vacío en el almacenamiento local
                guardarCarritoEnAlmacenamiento();

                // Actualizar el contenido del carrito para que esté vacío
                actualizarCarrito();

                // Redirigir al usuario a la página de finalización de compra
                window.location.href = this.href;
            });
        }

        // Agregar el elemento del carrito al contenido del carrito
        carritoContenido.appendChild(elementoCarrito);

        // Agregar eventos a los botones de eliminar y aumentar cantidad
        const botonesEliminar = document.querySelectorAll(".eliminar-producto");
        botonesEliminar.forEach((boton) => {
            boton.addEventListener("click", function () {
                const codigoProducto = this.getAttribute("data-codigo");
                eliminarProducto(codigoProducto);
            });
        });

        const botonesAumentarCantidad =
            document.querySelectorAll(".aumentar-cantidad");
        botonesAumentarCantidad.forEach((boton) => {
            boton.addEventListener("click", function () {
                const codigoProducto = this.getAttribute("data-codigo");
                aumentarCantidad(codigoProducto);
            });
        });
    }

    // Popup carrito
    carritoLink.addEventListener("click", function (event) {
        event.preventDefault();
        toggleCarrito();
    });

    // Función para abrir/cerrar el carrito
    function toggleCarrito() {
        carritoPopup.style.display =
            carritoPopup.style.display === "none" ? "block" : "none";
    }

    // Cargar productos al cargar la página
    cargarProductos();



});

