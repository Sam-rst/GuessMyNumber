<?php

if (isset($_SESSION['message']) && isset($_SESSION['messageColor'])) {
    if ($_SESSION['messageColor'] == "success") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><strong>Success : </strong>
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    } else if ($_SESSION['messageColor'] == "danger") { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Attention : </strong>
            <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
    } else if ($_SESSION['messageColor'] == "warning") { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Problème : </strong>
            <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
    } else if ($_SESSION['messageColor'] == "info") { ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-bell-fill"></i><strong> Info : </strong>
            <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        <?php
    } else { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Problème : </strong> Il y a un soucis avec l'affichage
                        du message
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        <?php
    }
    // Une fois l'affichage terminé, on détruit les variables de session
    unset($_SESSION['message']);
    unset($_SESSION['messageColor']);

}