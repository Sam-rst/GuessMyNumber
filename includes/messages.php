<?php
class AlertManager
{
    private $type;
    private $message;

    public function __construct($type = null, $message = null)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function setAlert($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public static function displayAlert($type, $message)
    {
        $icon = self::getIcon($type);
        $typeText = self::getTypeText($type);
        echo "<div class=\"alert alert-{$type} alert-dismissible fade show\" role=\"alert\">";
        echo "<i class=\"bi {$icon} me-2\"></i><strong>{$typeText} : </strong>";
        echo htmlspecialchars($message);
        echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>";
        echo "</div>";
    }

    private function getIcon($type)
    {
        switch ($type) {
            case 'success':
                return 'bi-check-circle-fill';
            case 'danger':
                return 'bi-exclamation-triangle-fill';
            case 'warning':
                return 'bi-exclamation-triangle-fill';
            case 'info':
                return 'bi-bell-fill';
            default:
                return 'bi-exclamation-circle-fill';
        }
    }

    private function getTypeText($type)
    {
        switch ($type) {
            case 'success':
                return 'Succès';
            case 'danger':
                return 'Attention';
            case 'warning':
                return 'Avertissement';
            case 'info':
                return 'Info';
            default:
                return 'Inconnu';
        }
    }
    
    public function getAlert()
    {
        return ['type' => $this->type, 'message' => $this->message];
    }
}
