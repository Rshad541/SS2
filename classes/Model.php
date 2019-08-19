<?php
/**
 * Model Class -
 * author - Rshad
 * Email - Rshad541@gmail.com
 */

 class Model
 {
   protected static $table;

   public function query($sql, $params=[])
   {
    return DB::getInstance()->query($sql,$params);
   }

   public function insert($fields)
   {
    return DB::getInstance()->insert(static::$table, $fields);
   }


   public function update($id,$fields)
   {
    return DB::getInstance()->update(static::$table,$id, $fields);
   }

   public function delete($id)
   {
    return DB::getInstance()->delete(static::$table, $id);
   }

   public function find($item)
   {
    return DB::getInstance()->find(static::$table, $item);
   }

   public function getBy($field, $value)
   {
    return DB::getInstance()->getBy(static::$table, $field, $value);
   }

   public static function getAll()
   {
    return DB::getAll(static::$table);
   }
 }
