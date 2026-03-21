package com.deepanshu.dk.db

import android.content.Context
import androidx.room.Database
import androidx.room.Room
import androidx.room.RoomDatabase

@Database(entities = [DKMemory::class], version = 1, exportSchema = false)
abstract class DKDatabase : RoomDatabase() {

    abstract fun memoryDao(): DKMemoryDao

    companion object {
        @Volatile private var INSTANCE: DKDatabase? = null

        fun getInstance(context: Context): DKDatabase =
            INSTANCE ?: synchronized(this) {
                INSTANCE ?: Room.databaseBuilder(
                    context.applicationContext,
                    DKDatabase::class.java,
                    "dk_database"
                ).build().also { INSTANCE = it }
            }
    }
}
