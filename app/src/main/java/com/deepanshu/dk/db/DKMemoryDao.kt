package com.deepanshu.dk.db

import androidx.room.Dao
import androidx.room.Insert
import androidx.room.OnConflictStrategy
import androidx.room.Query
import kotlinx.coroutines.flow.Flow

@Dao
interface DKMemoryDao {

    @Insert(onConflict = OnConflictStrategy.REPLACE)
    suspend fun insert(memory: DKMemory)

    @Query("SELECT * FROM dk_memory ORDER BY timestamp ASC")
    fun getAll(): Flow<List<DKMemory>>

    @Query("SELECT * FROM dk_memory ORDER BY timestamp DESC LIMIT :limit")
    suspend fun getRecent(limit: Int = 20): List<DKMemory>

    @Query("DELETE FROM dk_memory")
    suspend fun clearAll()
}
