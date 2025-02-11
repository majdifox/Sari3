<?php
namespace App\Models;

use Core\Model;

class User extends Model {
    protected $table = 'utilisateurs';
     
    public function getAllUsers() {
        $sql = "SELECT * FROM {$this->table} ORDER BY date_creation DESC";
        return $this->query($sql);
    }

    public function getAllConducteurs() {
        $sql = "SELECT * FROM {$this->table} WHERE role = 'Conducteur'";
        return $this->query($sql);
    }

    public function getAllExpediteurs() {
        $sql = "SELECT * FROM {$this->table} WHERE role = 'Expediteur'";
        return $this->query($sql);
    }

    public function get($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->query($sql, [$id]);
        return $result[0] ?? null;
    }

    public function update($data) {
        $id = $data['id'];
        unset($data['id']);
        
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = "{$key} = ?";
        }
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $sets) . " WHERE id = ?";
        $values = array_values($data);
        $values[] = $id;
        
        return $this->execute($sql, $values);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->execute($sql, [$id]);
    }

    public function toggleStatus($id) {
        $sql = "UPDATE {$this->table} SET etat = 
                CASE 
                    WHEN etat = 'Normal' THEN 'Banne'
                    ELSE 'Normal'
                END 
                WHERE id = ?";
        return $this->execute($sql, [$id]);
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
                    COUNT(CASE WHEN etat = 'Normal' THEN 1 END) as actifs,
                    COUNT(CASE WHEN etat = 'Banne' THEN 1 END) as bannis
                FROM {$this->table}
                GROUP BY role";
        return $this->query($sql);
    }
}