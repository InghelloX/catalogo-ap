<?php $scripts = ['js/catalogo.js']; ?>

<header class="page-head">
    <div>
        <p class="eyebrow eyebrow-dark mb-1">Promociones vigentes</p>
        <h1 class="page-title">Hola, <?= e(explode(' ', $usuario['nombre'])[0]) ?> 👋</h1>
        <p class="text-secondary mb-0">
            <?= count($productos) ?> <?= count($productos) === 1 ? 'oferta disponible' : 'ofertas disponibles' ?> ahora mismo.
        </p>
    </div>
</header>

<?php if (empty($productos)): ?>
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h2>No hay promociones activas</h2>
        <p>Vuelve pronto: publicamos nuevas ofertas cada semana.</p>
    </div>
<?php else: ?>

    <div class="toolbar" role="search">
        <div class="input-icon flex-grow-1">
            <i class="bi bi-search"></i>
            <input type="search" class="form-control" id="buscar" placeholder="Buscar producto…" aria-label="Buscar producto">
        </div>
        <div class="chips" role="group" aria-label="Filtrar por categoría">
            <button type="button" class="chip active" data-categoria="">Todas</button>
            <?php foreach ($categorias as $cat): ?>
                <button type="button" class="chip" data-categoria="<?= e($cat) ?>"><?= e($cat) ?></button>
            <?php endforeach; ?>
        </div>
        <select class="form-select toolbar-sort" id="ordenar" aria-label="Ordenar">
            <option value="fin">Terminan antes</option>
            <option value="descuento">Mayor descuento</option>
            <option value="precio-asc">Precio: menor a mayor</option>
            <option value="precio-desc">Precio: mayor a menor</option>
        </select>
    </div>

    <div class="row g-4" id="grid">
        <?php foreach ($productos as $i => $p):
            $urgente = $p['dias_restantes'] <= 7;
        ?>
            <div class="col-sm-6 col-lg-4 producto"
                 data-nombre="<?= e(mb_strtolower($p['nombre'] . ' ' . $p['descripcion'])) ?>"
                 data-categoria="<?= e($p['categoria']) ?>"
                 data-descuento="<?= (int) $p['descuento'] ?>"
                 data-precio="<?= (float) $p['precio_promocion'] ?>"
                 data-fin="<?= (int) $p['dias_restantes'] ?>"
                 data-orden="<?= $i ?>">
                <article class="product-card h-100">
                    <div class="product-visual visual-<?= $i % 4 ?>">
                        <i class="bi bi-<?= icono_producto($p) ?>" aria-hidden="true"></i>
                        <span class="discount-badge">-<?= (int) $p['descuento'] ?>%</span>
                    </div>
                    <div class="product-body">
                        <span class="product-cat"><?= e($p['categoria']) ?></span>
                        <h2 class="product-name"><?= e($p['nombre']) ?></h2>
                        <p class="product-desc"><?= e($p['descripcion']) ?></p>

                        <div class="price-row">
                            <span class="price-now"><?= precio($p['precio_promocion']) ?></span>
                            <span class="price-old"><?= precio($p['precio_original']) ?></span>
                        </div>
                        <p class="saving">Ahorras <?= precio($p['ahorro']) ?></p>

                        <div class="product-foot">
                            <span class="deadline<?= $urgente ? ' deadline-urgent' : '' ?>">
                                <i class="bi bi-clock"></i>
                                <?= $p['dias_restantes'] === 0 ? 'Termina hoy' : 'Quedan ' . $p['dias_restantes'] . ($p['dias_restantes'] === 1 ? ' día' : ' días') ?>
                            </span>
                            <button type="button" class="btn btn-sm btn-ink" data-bs-toggle="modal" data-bs-target="#detalle-<?= (int) $p['id'] ?>">
                                Ver detalles
                            </button>
                        </div>
                    </div>
                </article>

                <!-- Modal de detalle -->
                <div class="modal fade" id="detalle-<?= (int) $p['id'] ?>" tabindex="-1" aria-labelledby="detalle-titulo-<?= (int) $p['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="product-visual visual-<?= $i % 4 ?> modal-visual">
                                <i class="bi bi-<?= icono_producto($p) ?>" aria-hidden="true"></i>
                                <span class="discount-badge">-<?= (int) $p['descuento'] ?>%</span>
                                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body p-4">
                                <span class="product-cat"><?= e($p['categoria']) ?></span>
                                <h3 class="h4 fw-bold mt-1" id="detalle-titulo-<?= (int) $p['id'] ?>"><?= e($p['nombre']) ?></h3>
                                <p class="text-secondary"><?= e($p['descripcion']) ?></p>
                                <dl class="detail-list">
                                    <div><dt>Precio de promoción</dt><dd class="price-now"><?= precio($p['precio_promocion']) ?></dd></div>
                                    <div><dt>Precio normal</dt><dd class="price-old"><?= precio($p['precio_original']) ?></dd></div>
                                    <div><dt>Ahorro</dt><dd class="text-success fw-semibold"><?= precio($p['ahorro']) ?> (<?= (int) $p['descuento'] ?>%)</dd></div>
                                    <div><dt>Vigencia</dt><dd><?= date('d/m/Y', strtotime($p['fecha_inicio'])) ?> – <?= date('d/m/Y', strtotime($p['fecha_fin'])) ?></dd></div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="empty-state d-none" id="sin-resultados">
        <i class="bi bi-search"></i>
        <h2>Sin resultados</h2>
        <p>Prueba con otra búsqueda o categoría.</p>
        <button type="button" class="btn btn-outline-ink btn-sm" id="limpiar-filtros">Limpiar filtros</button>
    </div>
<?php endif; ?>
