<?php
namespace App\Models;

use Core\Model;

class User extends Model {
    protected $table = 'utilisateurs';
    
    public function getAllUsers() {
        $sql = "SELECT * FROM {$this->table} ORDER BY date_creation DESC";
        return $this->query($sql);
    }

    public function countAll() {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $result = $this->query($sql);
        return $result[0]['count'];
    }

    public function countByRole($role) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE role = ?";
        $result = $this->query($sql, [$role]);
        return $result[0]['count'];
    }

    public function getUserStats() {
        $sql = "SELECT 
                    role,
                    COUNT(*) as total,
                    COUNT(CASE WHEN etat = 'Normal' THEN 1 END) as active,
                    COUNT(CASE WHEN etat = 'Banne' THEN 1 END) as banned
                FROM {$this->table}
                GROUP BY role";
        return $this->query($sql);
    }

    public function toggleStatus($userId) {
        $sql = "UPDATE {$this->table} 
                SET etat = CASE 
                    WHEN etat = 'Normal' THEN 'Banne'
                    ELSE 'Normal'
                END 
                WHERE id = ?";
        return $this->execute($sql, [$userId]);
    }
}
