import { Request, Response } from "express";

export class LoginController {
    static login(req: Request, res: Response) {
        const { user, password } = req.body
        res.status(200).json({ ok: true, isLogged: true })
    }
}