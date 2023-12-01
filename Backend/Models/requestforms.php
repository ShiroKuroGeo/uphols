<?php
    class requestforms{

        //Entities
        private $table = 'requestform';
        private $id = 'requestForm_id ';
        private $ty = 'Types';
        private $tp = 'typePrice';
        private $c = 'Color';
        private $cp = 'colorPrice';
        private $fb = 'fabric';
        private $fbt = 'fabricPrice';

        //Publics
        public function selectAll(){
            return $this->selectAllQuery();
        }

        public function storeDesign(){
            return $this->storeDesignQuery();
        }

        public function deleteDesignUsingId(){
            return $this->deleteDesignUsingIdQuery();
        }

        public function updateDesignUsingId(){
            return $this->updateDesignUsingIdQuery();
        }

        //privates
        private function selectAllQuery(){
            return "SELECT * FROM $this->table ORDER BY created_at DESC";
        }

        private function storeDesignQuery(){
            return "INSERT INTO $this->table ($this->ty, $this->tp, $this->c, $this->cp, $this->fb, $this->fbt) VALUES(?,?,?,?,?,?)";
        }

        private function deleteDesignUsingIdQuery(){
            return "DELETE FROM $this->table WHERE $this->id = ?";
        }

        private function updateDesignUsingIdQuery(){
            return "UPDATE $this->table SET $this->ty = ? , $this->tp = ? , $this->c = ? , $this->cp = ? , $this->fb = ? , $this->fbt = ? WHERE $this->id = ?";
        }

    }
?>