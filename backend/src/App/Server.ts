import cors from 'cors'
import express, { Application } from 'express'
import { LoginModule } from '../Modules/Login/LoginModule'
import { PORT } from './Constants'
import { Module } from './Module'
import { ModuleManager } from './ModuleManager'

export class Server extends ModuleManager {
    private static _instance: Server
    // Referencia de applicacion express
    private app: Application
    // Inicializacion de servidor con express
    private constructor() {
        const app = express()
        super(app)
        this.app = app
        this.app.use(express.urlencoded({ extended: true }))
        this.app.use(express.json())
        this.app.use(cors())
        this.prepareModules()
        this.run()
    }
    // Abstract factory for modules
    protected getModules(): Module[] {
        return [
            LoginModule,
        ]
    }
    // Singleton instance for server
    static get instance() {
        if (!this._instance) {
            this._instance = new Server()
        }
        return this._instance
    }
    // Run application server
    private run() {
        this.app.listen(PORT, () => {
            console.log("server runing on port 3000 ✨")
        })
    }
}
