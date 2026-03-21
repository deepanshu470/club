package com.deepanshu.dk.db

import androidx.room.Entity
import androidx.room.PrimaryKey

@Entity(tableName = "dk_memory")
data class DKMemory(
    @PrimaryKey(autoGenerate = true) val id: Long = 0,
    val role: String,        // "user" or "dk"
    val content: String,
    val timestamp: Long = System.currentTimeMillis()
)
